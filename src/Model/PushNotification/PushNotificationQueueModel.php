<?php


namespace App\Model\PushNotification;

use App\Entity\MobileDevice;
use App\Model\Base\BaseModel;
use App\Entity\PushNotificationQueue;
use App\Exception\ApiException;
use App\Exception\ItemNotFoundException;
use App\Util\ApiPaginator;
use App\Util\ApiResponseBag;
use Doctrine\ORM\AbstractQuery;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use App\Services\OneSignalService;

/**
 * Class PushNotificationQueueModel
 * @package App\Model
 * @property PushNotificationQueue $entity
 */
class PushNotificationQueueModel extends BaseModel
{
    /** @var MobileDevice[] */
    private $mobileDeviceList = [];

    /** @var array */
    private $pushNotificationIdList = [];

    public function __construct(array $payload = null)
    {
        $this->payload = $payload;
        $this->entity = new PushNotificationQueue();
        $this->entityName = PushNotificationQueue::class;
    }

    public function sendNotifications(): ApiResponseBag
    {
        return $this->execute(function () {

            $pushNotificationOnQueueList = $this->findPushNotificationQueueList(
                PushNotificationQueue::STATUS_IN_QUEUE
            );

            foreach ($pushNotificationOnQueueList as $pushNotification)
            {
                $mobileDevice = $pushNotification->getMobileDevice();
                $this->mobileDeviceList[] = $mobileDevice;
                $this->pushNotificationIdList[] = $mobileDevice->getPushNotificationId();

                $pushNotification->setStatus(1);
                db()->persist($pushNotification);
            }

            if (!empty($this->pushNotificationIdList)) {
                $oneSignalService = new OneSignalService($this->pushNotificationIdList);
                $what = $oneSignalService->sendPushNotification('Você foi chamado pelo professor');
            }

            db()->flush();
            db()->commit();

            return ApiResponseBag::success(
                null, [], 'Informações de notificação atualizadas!'
            );
        }, true, false);
    }

    /**
     * @param $status
     * @return PushNotificationQueue[]
     */
    private function findPushNotificationQueueList($status): array
    {
        $repo = db()->getRepository(PushNotificationQueue::class);
        $qb = $repo->createQueryBuilder('pnq')
            ->andWhere('pnq.deletedAt IS NULL')
            ->andWhere('pnq.statusCode = 1')
            ->andWhere('pnq.status = :status')
            ->setParameter('status', $status);
        $result = $qb->getQuery()->getResult();

        if ($result === null) {
            throw new ItemNotFoundException();
        }
        return $result;
    }

}
