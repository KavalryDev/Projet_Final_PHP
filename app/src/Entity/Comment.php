<?php

namespace App\Entity;

class Comment
{
    private int $id;
    private string $content;
    private \DateTime $creationDate;
    private int $idUser;
    private int $idPost;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
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
     * @return \DateTime
     */
    public function getCreationDate(): \DateTime
    {
        return $this->creationDate;
    }

    /**
     * @param \DateTime $creationDate
     */
    public function setCreationDate(\DateTime $creationDate): void
    {
        $this->creationDate = $creationDate;
    }

    /**
     * @return int
     */
    public function getIdUser(): int
    {
        return $this->idUser;
    }

    /**
     * @param int $idUser
     */
    public function setIdUser(int $idUser): void
    {
        $this->idUser = $idUser;
    }

    /**
     * @return int
     */
    public function getIdPost(): int
    {
        return $this->idPost;
    }

    /**
     * @param int $idPost
     */
    public function setIdPost(int $idPost): void
    {
        $this->idPost = $idPost;
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