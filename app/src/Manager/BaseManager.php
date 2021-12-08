<?php

namespace App\Manager;

use App\Fram\Factories\PDOFactory;

abstract class BaseManager
{
    protected $db;

    public function __construct()
    {
        $this->db = PDOFactory::getMysqlConnection();
    }
}