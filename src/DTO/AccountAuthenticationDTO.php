<?php

namespace App\DTO;

use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class AccountAuthenticationDTO
 * @package App\DTO
 */
class AccountAuthenticationDTO
{
//    /**
//     * @var UuidInterface
//     * @Groups({"hide"})
//     */
//    private $guid;
    /**
     * @var UuidInterface
     * @Groups({"default"})
     */
    private $accountId;
    /**
     * @var string
     * @Groups({"write","default"})
     * @Assert\NotBlank(groups={"write"})
     */
    private $username;
    /**
     * @var string
     * @Groups({"default"})
     */
    private $fullName;
    /**
     * @var string
     * @Groups({"default"})
     */
    private $legalName;
    /**
     * @var string|null
     * @Groups({"write"})
     */
    private $password;
    /**
     * @var string|null
     * @Groups({"default", "write"})
     */
    private $token;


//    /**
//     * @return UuidInterface
//     */
//    public function getGuid(): UuidInterface
//    {
//        return $this->guid;
//    }
//
//    /**
//     * @param UuidInterface $guid
//     */
//    public function setGuid(UuidInterface $guid): void
//    {
//        $this->guid = $guid;
//    }

    /**
     * @return UuidInterface
     */
    public function getAccountId(): UuidInterface
    {
        return $this->accountId;
    }

    /**
     * @param UuidInterface $accountId
     */
    public function setAccountId(UuidInterface $accountId): void
    {
        $this->accountId = $accountId;
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
     * @return string|null
     */
    public function getLegalName(): ?string
    {
        return $this->legalName;
    }

    /**
     * @param string|null $legalName
     */
    public function setLegalName(?string $legalName): void
    {
        $this->legalName = $legalName;
    }

    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param string|null $password
     */
    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return string|null
     */
    public function getToken(): ?string
    {
        return $this->token;
    }

    /**
     * @param string|null $token
     */
    public function setToken(?string $token): void
    {
        $this->token = $token;
    }


}
