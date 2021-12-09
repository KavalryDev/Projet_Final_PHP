<?php

namespace App\Manager;

use App\Entity\User;
use App\Fram\Factories\PDOFactory;

class UserManager extends BaseManager
{

    /**
     * @return array
     */
    public function getAllUsers(): array
    {
        $select = $this->db->query('SELECT * FROM User');
        $select->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'Entity/User');
        return $select->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * @param User $user
     */
    public function createUser(User $user): void
    {

        try {
            $select = $this->db->query(
                'INSERT INTO `User` (`id`, `Firstname`, `Lastname`, `Password`, `Email`, `IsAdmin`)
            VALUES (
                    NULL,
                    "' . $user->getFirstname() . '",
                    "' . $user->getLastname() . '",
                    "' . $user->getPassword() . '",
                    "' . $user->getEmail() . '",
                    "' . $user->isAdmin() . '")'
            );
        } catch (\Exception $e) {
            die('MySQL Error : ' . $e->getMessage());
        }
        // return message via Flash
    }

    /**
     * @param int $id
     * @return User
     */
    public function getUserById(int $id): User
    {
        $select = $this->db->prepare('SELECT * FROM User WHERE id=:id');
        $select->bindValue(':id', $id, \PDO::PARAM_INT);
        $select->execute();

        $result = $select->fetch(\PDO::FETCH_ASSOC);

        return new User($result);
    }

    /**
     * @param User $user
     * @param int $id
     */
    public function updateUserById(User $user): void
    {
        try {
            $select = $this->db->prepare(
                'UPDATE `User` SET `Firstname`=:firstname, `Lastname`=:lastname, `Password`=:password, `Email`=:email, `isAdmin`=:isAdmin WHERE id=:id'
            );
            $select->bindValue(':firstname',$user->getFirstname(),\PDO::PARAM_STR);
            $select->bindValue(':lastname',$user->getLastname(),\PDO::PARAM_STR);
            $select->bindValue(':password',$user->getPassword(),\PDO::PARAM_STR);
            $select->bindValue(':email',$user->getEmail(),\PDO::PARAM_STR);
            $select->bindValue(':isAdmin',$user->isAdmin(),\PDO::PARAM_BOOL);
            $select->bindValue(':id',$user->getId(),\PDO::PARAM_INT);

            $select->execute();
        } catch (\Exception $e) {
            die('MySQL Error : ' . $e->getMessage());
        }
        // return message via Flash
    }

    /**
     * @param int $id
     */
    public function deleteUserById(int $id): void
    {
        try {
            $select = $this->db->prepare('DELETE FROM `User` WHERE `id`=:id');
            $select->bindValue(':id', $id, \PDO::PARAM_INT);
            $select->execute();
        } catch (\Exception $e) {
            die('MySQL Error : ' . $e->getMessage());
        }
    }

    /**
     * @param int $id
     */
    public function updateAdminRightById(int $id,bool $isAdmin): void
    {
        try {
            $select = $this->db->prepare(
                'UPDATE `User` SET `isAdmin`=:isAdmin WHERE id=:id'
            );
            $select->bindValue(':isAdmin',$isAdmin,\PDO::PARAM_BOOL);
            $select->bindValue(':id',$id,\PDO::PARAM_INT);

            $select->execute();
        } catch (\Exception $e) {
            die('MySQL Error : ' . $e->getMessage());
        }
        // return message via Flash
    }
}