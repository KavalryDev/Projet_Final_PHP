<?php

namespace App\Fram\Factories;

class PDOFactory
{
    public static function getMysqlConnection()
    {
        $host = 'db';
        $username = 'root';
        $password = 'example';

        $conn = null;
        try {
            $conn = new \PDO('mysql:host='.$host.';dbname=Blog',$username,$password);

            $conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }
        catch(\PDOException $e) {
            die('Connection Error : ' . $e->getMessage());
        }

        return $conn;
    }
}