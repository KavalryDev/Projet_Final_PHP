<?php

namespace App\Fram\Factories;

class PDOFactory
{
    private $host = 'db';
    private $database_name = 'player';
    private $username = 'root';
    private $password = 'example';

    public function __construct()
    {
        $this->data = null;
        try {
            $this->data = new PDO('mysql:host='. $this->host . ';dbname=' . $this->database_name, $this->username, $this->password);

            $this->data->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e) {
            die('Connection Error : ' . $e->getMessage());
        }
    }
}