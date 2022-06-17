<?php


namespace App\Model;

use App\Model\Base\BaseModel;
use App\Entity\Fidelity\MobileDevice;
use App\Exception\ApiException;
use App\Exception\ItemNotFoundException;
use App\Util\ApiPaginator;
use App\Util\ApiResponseBag;
use Doctrine\ORM\AbstractQuery;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;

/**
 * Class MobileDeviceModel
 * @package App\Model
 * @property MobileDevice $entity
 */
class MobileDeviceModel extends BaseModel
{
    public function __construct(array $payload = null)
    {
        $this->payload = $payload;
        $this->entity = new MobileDevice();
        $this->entityName = MobileDevice::class;
    }

    public function updateNotificationInfo(): JsonResponse
    {
        return $this->execute(function () {
            $mobileDeviceId = $this->getValue('deviceId');
            $pushNotificationId = $this->getValue('pushNotificationId');
            $pushNotificationService = $this->getValue('pushNotificationService');

            $this->entity = $this->findMobileDeviceById(
                $mobileDeviceId
            );


            $this->entity->setPushNotificationId($pushNotificationId);
            $this->entity->setPushNotificationService($pushNotificationService);

            if ($pushNotificationId !== '' && $pushNotificationId !== null) {
                db()->persist($this->entity);
            }
            db()->flush();
            db()->commit();

            return ApiResponseBag::success(
                null, [], 'Informações de notificação atualizadas!'
            );
        });
    }

    private function findMobileDeviceById($id)
    {

        $repo = db()->getRepository(MobileDevice::class);
        $qb = $repo->createQueryBuilder('md')
            ->andWhere('md.deletedAt IS NULL')
            ->andWhere('md.statusCode = 1')
            ->andWhere('md.deviceId = :id')
            ->setParameter('id', $id)
            ->orderBy('md.createdAt', 'ASC')
            ->setMaxResults(1);
        $result = $qb->getQuery()->getOneOrNullResult();

        if ($result === null) {
            throw new ItemNotFoundException();
        }
        return $result;
    }

}
