<?php

namespace App\Manager;

use App\Entity\Post;

class PostManager extends BaseManager
{
    /**
     * @return Post[]
     */
    public function getAllPosts(): array
    {
        $select = $this->db->query('SELECT * FROM Post');
        $select->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'Entity/Post');
        return $select->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * @param int $id
     * @return Post|false
     */
    public function getPostById(int $id)
    {
        $select = $this->db->prepare('SELECT * FROM Post WHERE id=:id');
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
     * @param int $id
     * @return Post
     */
    public function getPostByIdWithComments(int $id): Post
    {
        $select = $this->db->prepare('SELECT * FROM Post WHERE id =:id');
        $select->bindValue(':id', $id, \PDO::PARAM_INT);
        $select->execute();

        $result = $select->fetch(\PDO::FETCH_ASSOC);
        $post = $result['Post'];
        return new $post($result);
    }

    /**
     * @param Post $post
     * @return Post|bool
     */
    public function createPost(Post $post): void
    {
        try {
            $select = $this->db->query(
                'INSERT INTO `Post` (`id`, `Title`, `Content`, `CreationDate`)
            VALUES (
                    NULL,
                    "' . $post->getTitle() . '",
                    "' . $post->getContent() . '",
                    "' . $post->getCreationDate() . '")'
            );
        } catch (\Exception $e) {
            die('MySQL Error : ' . $e->getMessage());
        }
        // return message via Flash
    }

    /**
     * @param Post $post
     * @return Post|bool
     */
    public function updatePostById(Post $post): void
    {
        try {
            $select = $this->db->prepare(
                'UPDATE `Post` SET `Title`=:title, `Content`=:content, WHERE id=:id'
            );
            $select->bindValue(':title',$post->getTitle(),\PDO::PARAM_STR);
            $select->bindValue(':content',$post->getContent(),\PDO::PARAM_STR);
            $select->bindValue(':id',$post>getId(),\PDO::PARAM_INT);

            $select->execute();
        } catch (\Exception $e) {
            die('MySQL Error : ' . $e->getMessage());
        }
        // return message via Flash
    }

    /**
     * @param int $id
     * @return bool
     */
    public function deletePostById(int $id): void
    {
        try {
            $select = $this->db->prepare('DELETE FROM `Post` WHERE `id`=:id');
            $select->bindValue(':id', $id, \PDO::PARAM_INT);
            $select->execute();
        } catch (\Exception $e) {
            die('MySQL Error : ' . $e->getMessage());
        }
        // return message via Flash
    }
}