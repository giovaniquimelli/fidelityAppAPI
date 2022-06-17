<?php

namespace App\DataFixtures;

use App\Entity\CompanyBranch;
use App\Entity\Fidelity\Users;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

// include dirname(dirname(__DIR__)) . '/config/helper_functions.php';

class AppFixtures extends Fixture
{
    /** @var UserPasswordEncoderInterface */
    private $encoder;
    /**
     * @var ValidatorInterface
     */
    private $validator;
    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(UserPasswordEncoderInterface $encoder, EntityManagerInterface $em)
    {
        $this->encoder = $encoder;
        $this->em = $em;
    }

    public function load(ObjectManager $manager)
    {
        $rootUsers = $this->createRootUsers();

        foreach ($rootUsers as $rootUser){
            $manager->persist($rootUser);

            $metadata = $this->em->getClassMetaData(get_class($rootUser));
            $metadata->setIdGeneratorType(\Doctrine\ORM\Mapping\ClassMetadata::GENERATOR_TYPE_NONE);
            $metadata->setIdGenerator(new \Doctrine\ORM\Id\AssignedGenerator());

            $manager->flush();
        }

        $companyBranch = $this->createCompanyBranch($manager);
        $manager->persist($companyBranch);
        $metadata = $this->em->getClassMetaData(get_class($companyBranch));
        $metadata->setIdGeneratorType(\Doctrine\ORM\Mapping\ClassMetadata::GENERATOR_TYPE_NONE);
        $metadata->setIdGenerator(new \Doctrine\ORM\Id\AssignedGenerator());
        $manager->flush();

        $user = $this->createUser($manager);
        $manager->persist($user);
        $manager->flush();


        // $this->insertRootUsers();
    }

    private function insertRootUsers()
    {
        $rootUsers = $this->createRootUsers();

        $sqlUser = <<<SQL
INSERT INTO "public"."users"(
                             "id", 
                             "email", 
                             "mobile_phone", 
                             "username", 
                             "password", 
                             "access_type", 
                             "is_active", 
                             "full_name", 
                             "guid", 
                             "created_at", 
                             "updated_at", 
                             "status_code") 
                             VALUES (?,?,?,?,?,?,?,?,?,?,?,?)
SQL;
        /** @var Users $rootUser */
        foreach ($rootUsers as $rootUser) {
            $this->em->getConnection()->executeQuery($sqlUser, [
                $rootUser->getId(),
                $rootUser->getEmail(),
                $rootUser->getMobilePhone(),
                $rootUser->getUsername(),
                $rootUser->getPassword(),
                $rootUser->getAccessType(),
                (int)$rootUser->getIsActive(),
                $rootUser->getFullName(),
                $rootUser->getGuid(),
                $rootUser->getCreatedAt()->format('Y-m-d H:i:s'),
                $rootUser->getUpdatedAt()->format('Y-m-d H:i:s'),
                $rootUser->getStatusCode(),
            ]);
        }
    }

    private function createRootUsers()
    {
        $users = [];
        $user = new Users();

        $user->setId(-1);
        $user->setEmail('sys_root@fidelity');
        $user->setMobilePhone('42984068587');
        $user->setUsername('sys_root');
        $user->setSalt('d2aa7fe5-8e9c-4059-b033-24c5a4719da0');
        $password = $this->encoder->encodePassword($user, '2def7fdb');
        $user->setPassword($password);
        $user->setAccessType(Users::ACCESS_TYPE_GOD);
        $user->setIsActive(false);
        $user->setFullName('Automated Root Processes');
        $user->setGuid(Uuid::uuid4());
        $user->setCreatedAt(new DateTime());
        $user->setUpdatedAt(new DateTime());
        $user->setStatusCode(-1);

        $user2 = clone $user;
        $user2->setId(-2);
        $user2->setEmail('sys_admin@fidelity');
        $user2->setUsername('sys_admin');
        $user2->setFullName('Automated Api Processes');
        $user2->setGuid(Uuid::uuid4());

        $user3 = clone $user;
        $user3->setId(-3);
        $user3->setEmail('sys_mobile@fidelity');
        $user3->setUsername('sys_mobile');
        $user3->setFullName('Automated Mobile Processes');
        $user3->setGuid(Uuid::uuid4());

        $user4 = clone $user;
        $user4->setId(-4);
        $user4->setEmail('sys_service@fidelity');
        $user4->setUsername('sys_service');
        $user4->setFullName('Automated Tasks Process');
        $user4->setGuid(Uuid::uuid4());

        $users[] = $user;
        $users[] = $user2;
        $users[] = $user3;
        $users[] = $user4;


        return $users;
    }

    private function createCompanyBranch($em)
    {
        $branch = new CompanyBranch();
        $branch->setId(1);
        $branch->setGuid(Uuid::uuid4());
        $branch->setActive(true);
        $branch->setName("Colégio Lobo - Ponta Grossa");
        $branch->setLegalName("Tangriane Curso Preparatórios");
        $branch->setCpfCnpj("12345678909876");

        $branch->setCreatedBy($em->getReference(Users::class, -1));
        $branch->setUpdatedBy($em->getReference(Users::class, -1));
        $branch->setCreatedAt(new DateTime());
        $branch->setUpdatedAt(new DateTime());

        return $branch;

    }

    private function createUser(EntityManager $em)
    {
        $user = new Users();

        $user->setId(1);
        $user->setEmail('andrekociuba@gmail.com');
        $user->setMobilePhone('42984068587');
        $user->setUsername('andrekociuba');
        $user->setSalt('d2aa7fe5-8e9c-4059-b033-24c5a4719da0');
        $password = $this->encoder->encodePassword($user, '123456');
        $user->setPassword($password);
        $user->setAccessType(Users::ACCESS_TYPE_ADMIN);
        $user->setIsActive(true);
        $user->setFullName('André Kociuba Ferreira');
        $user->setGuid(Uuid::uuid4());
        $user->setCompanyBranch($em->getReference(CompanyBranch::class, 1));
        $user->setCreatedBy($em->getReference(Users::class, -1));
        $user->setUpdatedBy($em->getReference(Users::class, -1));
        $user->setCreatedAt(new DateTime());
        $user->setUpdatedAt(new DateTime());
        $user->setStatusCode(-1);

        return $user;
    }

    private function createUserAndPerson()
    {

    }
}
