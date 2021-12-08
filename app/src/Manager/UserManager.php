<?php

namespace App\Manager;

use App\Entity\User;
use App\Fram\Factories\PDOFactory;

class UserManager extends BaseManager
{
    // Querys -> getAll / Add / getById / Update / Delete

    public function getAllUsers(): array
    {
        // TODO - add Query method
        return [];
    }

    public function createUser(): void
    {
        // TODO - add Query method
    }

    public function getUserById(int $id): User
    {
        // TODO - add Query method
        return new User();
    }

    public function updateUser(): void
    {
        // TODO - add Query method
    }

    public function deleteUserById(int $id): void
    {
        // TODO - add Query method
    }
}