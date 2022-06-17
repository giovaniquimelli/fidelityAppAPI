<?php


namespace App\DTO;


use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

class UsersAuthenticationDTO
{
    /**
     * @var UuidInterface
     * @Groups({"read"})
     */
    private $guid;
    /**
     * @var string
     * @Groups({"write","default"})
     * @Assert\NotBlank(groups={"write"})
     */
    private $username;
    /**
     * @var string
     * @Groups({"read"})
     */
    private $fullName;
    /**
     * @var string
     * @Groups({"write"})
     * @Assert\NotBlank(groups={"write"})
     */
    private $password;
    /**
     * @var string
     * @Groups({"read","check"})
     */
    private $token;


    /**
     * @return UuidInterface
     */
    public function getGuid(): UuidInterface
    {
        return $this->guid;
    }

    /**
     * @param UuidInterface $guid
     */
    public function setGuid(UuidInterface $guid): void
    {
        $this->guid = $guid;
    }


    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getFullName(): string
    {
        return $this->fullName;
    }

    /**
     * @param string $fullName
     */
    public function setFullName(string $fullName): void
    {
        $this->fullName = $fullName;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @param string $token
     */
    public function setToken(string $token): void
    {
        $this->token = $token;
    }
}
