<?php

namespace App\Entity;

class Admin extends User
{

    public function __construct($db, $data) {
        parent::__construct($db, $data);

    }
}