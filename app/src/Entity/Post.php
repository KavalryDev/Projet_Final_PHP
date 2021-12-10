<?php

namespace App\Entity;

use App\Fram\Factories\PDOFactory;
use App\Manager\UserManager;

class Post
{
    private int $idPost;
    private string $title;
    private string $content;
    private \DateTime $creationDate;
    private $idUser;
    // Pour le bon fonctionnement malgré l'absence de la feature Users fonctionnelles
    // le typehint a été retiré pour $idUser afin de permettre l'accès aux Articles qui
    // ont été créés à partir du form, et donc sans user / author affecté

    /**
     * @return User
     */
    public function getAuthor(): User
    {
        return (new UserManager(PDOFactory::getMysqlConnection()))->getUserById($this->getIdUser());
    }

    /**
     * @return int
     */
    public function getIdPost(): int
    {
        return $this->idPost;
    }

    /**
     * @param int $id
     */
    public function setIdPost(int $id): void
    {
        $this->idPost = $id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getCreationDate(): string
    {
        return $this->creationDate->format('Y-m-d H:i:s');
    }

    /**
     * @param string $creationDate
     */
    public function setCreationDate(string $creationDate): void
    {
        $this->creationDate = \DateTime::createFromFormat('Y-m-d H:i:s',$creationDate);
    }

    /**
     * @return int
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * @param $idUser
     */
    public function setIdUser($idUser): void
    {
        $this->idUser = $idUser;
    }


    /**
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $this->hydrate($data);
    }

    /**
     * @param array $data
     */
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