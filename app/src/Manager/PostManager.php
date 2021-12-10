<?php

namespace App\Manager;

use App\Entity\Post;
use App\Entity\User;
use App\Fram\Utils\Flash;

class PostManager extends BaseManager
{
    /**
     * @return Post[]
     */
    public function getAllPosts(): array
    {
        $select = $this->db->query(
            'SELECT `Post`.*, `User`.`idUser`, `User`.`Firstname`, `User`.`Lastname`
                       FROM `Post`
                       LEFT JOIN `User`
                       ON `Post`.`idUser` = `User`.`idUser`'
        );
        $select->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'Entity/Post');
        return $select->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * @param int $id
     * @return Post|false
     */
    public function getPostById(int $id)
    {
        $select = $this->db->prepare(
            'SELECT `Post`.*, `User`.`idUser`, `User`.`Firstname`, `User`.`Lastname` 
                    FROM `Post` 
                    LEFT JOIN `User` 
                    ON `Post`.`idUser` = `User`.`idUser` 
                    WHERE `Post`.`idPost` = :id;'
        );
        $select->bindValue(':id', $id, \PDO::PARAM_INT);
        $select->execute();

        if ($select->rowCount() > 0) {
            $result = $select->fetch(\PDO::FETCH_ASSOC);
            return new Post($result);
        } else {
            return false;
        }
    }

    /**
     * @param Post $post
     * @return Post|bool
     */
    public function createPost(Post $post): void
    {
        try {
            $select = $this->db->query(
                'INSERT INTO `Post` (`idPost`, `Title`, `Content`, `CreationDate`)
            VALUES (
                    NULL,
                    "' . $post->getTitle() . '",
                    "' . $post->getContent() . '",
                    "' . $post->getCreationDate() . '")'
            );
        } catch (\Exception $e) {
            die('MySQL Error : ' . $e->getMessage());
        }
    }

    /**
     * @param Post $post
     * @return Post|bool
     */
    public function updatePostById(Post $post): void
    {
        try {
            $select = $this->db->prepare(
                'UPDATE `Post` SET `Title`=:title, `Content`=:content, WHERE `idPost`=:id'
            );
            $select->bindValue(':title',$post->getTitle(),\PDO::PARAM_STR);
            $select->bindValue(':content',$post->getContent(),\PDO::PARAM_STR);
            $select->bindValue(':id',$post>getIdPost(),\PDO::PARAM_INT);

            $select->execute();
        } catch (\Exception $e) {
            die('MySQL Error : ' . $e->getMessage());
        }
    }

    /**
     * @param int $id
     * @return bool
     */
    public function deletePostById(int $id): void
    {
        try {
            $select = $this->db->prepare('DELETE FROM `Post` WHERE `idPost`=:id');
            $select->bindValue(':id', $id, \PDO::PARAM_INT);
            $select->execute();
        } catch (\Exception $e) {
            die('MySQL Error : ' . $e->getMessage());
        }
    }
}