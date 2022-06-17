<?php

namespace App\DTO;

use App\Doctrine\Types\Date;
use App\Entity\Fidelity\Account;
use App\Util\Container\Serializer;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;

class AccountQuickRegistrationDTO
{
    public string $personId;
    public string $personType;
    public string $account;
    public string $username;
    public string $password;
    public string $mobilePhone;
    public string $fullName;
    public string $legalName;
    public bool $active = true;
//    /**
//     * @var Date
//     */
//    public Date $birthDate;
    public string $email;
    /**
     * @var string
     */
    public string $code;

    public static function fromAccount(Account $account): self
    {
        $dto = new self;
        $dto->personId = $account->getPerson()->getId()->toString();
        $dto->personType = $account->getPerson()->getPersonType();
        $dto->account = $account->getId()->toString();
        $dto->username = $account->getPerson()->getCpfCnpj();
        $dto->password = $account->getPassword();
        $dto->mobilePhone = $account->getMobilePhone();
        $dto->fullName = $account->getFullName();
        $dto->legalName = $account->getLegalName() ?? '';
        $dto->active = $account->isActive();
        $dto->email = $account->getEmail();
        return $dto;
    }

    /**
     * @param $payload
     * @return static
     * @throws \JsonException
     */
    public static function fromPayload($payload): self
    {
        $dto = new self;
        Serializer::deserialize(
            json_encode($payload, JSON_THROW_ON_ERROR, 512),
            __CLASS__,
            [],
            'json',
            [
                AbstractNormalizer::OBJECT_TO_POPULATE => $dto
            ]
        );
        return $dto;
    }
}
