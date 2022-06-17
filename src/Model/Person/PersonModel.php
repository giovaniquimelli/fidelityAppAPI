<?php


namespace App\Model\Person;

use App\Entity\Person;
use App\Exception\ApiException;
use App\Exception\ItemNotFoundException;
use App\Model\Base\BaseModel;
use App\Util\ApiResponseBag;
use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * Class PersonModel
 * @package App\Model
 * @property Person $entity
 */
class PersonModel extends BaseModel
{
    public function __construct(array $payload = null)
    {
        $this->entity = new Person();
        $this->entityName = Person::class;
        $this->payload = $payload;
    }
}
