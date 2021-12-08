<?php

namespace App\Manager;

class UserManager
{
    public function __construct(array $data = [])
    {
        $this->hydrate($data);
    }

    public function hydrate(array $data) // $data = $_POST
    {
        foreach($data as $key => $value) { // $data = $_POST // $key = $_POST['name'] // $value = "Jacquy"

            $method = 'set' . ucfirst($key); // set"?"() <- setName() setFirstName setID

            if(is_callable([$this, $method])) { // if setName exists
                $this->$method($value); // then launch setName("Jacquy")
            }
        }
    }
}