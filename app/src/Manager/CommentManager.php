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
        $select = $this->db->query('SELECT * FROM `Comment`');
        $select->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'Entity/Comment');
        return $select->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * @return Comment[]
     */
    public function getAllCommentsByPostId(int $idPost): array
    {
        $select = $this->db->prepare('SELECT * FROM `Comment` WHERE idPost=:idPost');
        $select->bindValue(':idPost', $idPost,\PDO::PARAM_INT);
        $select->execute();

        $select->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'Entity/Comment');
        return $select->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * @param int $id
     * @return Comment
     */
    public function getCommentById(int $id): Comment
    {
        $select = $this->db->prepare('SELECT * FROM `Comment` WHERE id =:id');
        $select->bindValue(':id', $id, \PDO::PARAM_INT);
        $select->execute();

        $result = $select->fetch(\PDO::FETCH_ASSOC);
        $comment = $result['Comment'];
        return new $comment($result);
    }

    /**
     * @param Comment $comment
     * @return void
     */
    public function createComment(Comment $comment): void
    {
        try {
            $select = $this->db->query(
                'INSERT INTO `Comment` (`id`, `Content`, `CreationDate`, `idUser`, `idPost`)
            VALUES (
                    NULL,
                    "' . $comment->getContent() . '",
                    "' . $comment->getCreationDate() . '",
                    "' . $comment->getIdUser() .'",
                    "' . $comment->getIdPost() .'")'
            );
        } catch (\Exception $e) {
            die('MySQL Error : ' . $e->getMessage());
        }
        // return message via Flash
    }

    /**
     * @param Comment $comment
     * @return void
     */
    public function updateCommentById(Comment $comment): void
    {
        try {
            $select = $this->db->prepare(
                'UPDATE `Comment` SET `Content`=:content, `CreationDate`=:creationDate, `idUser`=:idUser, `idPost`=:idPost WHERE id=:id'
            );
            $select->bindValue(':content',$comment->getContent(),\PDO::PARAM_STR);
            $select->bindValue(':creationDate',$comment->getCreationDate(),\PDO::PARAM_STR);
            $select->bindValue(':idUser',$comment->getIdUser(),\PDO::PARAM_INT);
            $select->bindValue(':idPost',$comment->getIdPost(),\PDO::PARAM_INT);
            $select->bindValue(':id',$comment->getIdComment(),\PDO::PARAM_INT);

            $select->execute();
        } catch (\Exception $e) {
            die('MySQL Error : ' . $e->getMessage());
        }
        // return message via Flash
    }

    /**
     * @param int $id
     * @return void
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