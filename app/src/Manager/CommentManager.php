<?php

namespace App\Manager;

use App\Entity\Comment;

class CommentManager extends BaseManager
{
    /**
     * @return Comment[]
     */
    public function getAllComments(): array
    {
        $select = $this->db->query('SELECT * FROM Comment');
        $select->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'Entity/Comment');
        return $select->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * @return Comment[]
     */
    public function getAllCommentsByPostId(int $idPost): array
    {
        $select = $this->db->prepare('SELECT * FROM Comment WHERE idPost=:idPost');
        $select->bindValue(':idPost', $idPost,\PDO::PARAM_INT);
        $select->execute();

        $select->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'Entity/Comment');
        return $select->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getCommentById(int $id): Comment
    {
        $select = $this->db->prepare('SELECT * FROM Comment WHERE id =:id');
        $select->bindValue(':id', $id, \PDO::PARAM_INT);
        $select->execute();

        $result = $select->fetch(\PDO::FETCH_ASSOC);
        $comment = $result['Comment'];
        return new $comment($result);
    }

    /**
     * @param Comment $comment
     * @return Comment|bool
     */

    public function updateCommentById(Comment $comment): void
    {
        try {
            $select = $this->db->prepare(
                'UPDATE `Comment` SET `Title`=:title, `Content`=:content, WHERE id=:id'
            );
            $select->bindValue(':title',$comment->getComment(),\PDO::PARAM_STR);
            $select->bindValue(':content',$comment->getContent(),\PDO::PARAM_STR);
            $select->bindValue(':id',$comment>getId(),\PDO::PARAM_INT);

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
    public function deleteCommentById(int $id): void
    {
        try {
            $select = $this->db->prepare('DELETE FROM `Comment` WHERE `id`=:id');
            $select->bindValue(':id', $id, \PDO::PARAM_INT);
            $select->execute();
        } catch (\Exception $e) {
            die('MySQL Error : ' . $e->getMessage());
        }
        // return message via Flash
    }
}