<?php


namespace App\Model\Users;

use App\Entity\Fidelity\CompanyBranch;
use App\Entity\Fidelity\Product;
use App\Entity\Fidelity\ProductCompanyBranch;
use App\Entity\Fidelity\Reward;
use App\Entity\Fidelity\RewardCompanyBranch;
use App\Entity\Fidelity\Users;
use App\Model\Base\BaseModel;
use App\Model\Base\IBaseModel;
use App\Util\ApiResponseBag;
use App\Util\Container\Serializer;
use App\Util\RewardTypes;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class RewardModel
 * @package App\Model
 * @property Product $entity
 */
class UsersModel extends BaseModel implements IBaseModel
{
    public function __construct(array $payload = null)
    {
        $this->payload = $payload;
        $this->entity = new Product();
        $this->entityName = Users::class;
    }

    public function create()
    {
        return $this->execute(function () {
            $this->deserialize();
            db()->persist($this->entity);
            db()->flush();

            db()->commit();
            return ApiResponseBag::success(
                $this->entity->normalize(['entity', 'relations']), [],
                'Premio adicionado com sucesso.'
            );
        });
    }

    public function update()
    {
        return $this->execute(function () {
            $this->entity = $this->findById($this->getValue('id'));
            $this->deserialize();
            db()->persist($this->entity);
            db()->flush();

            db()->commit();
            return ApiResponseBag::success(
                $this->entity->normalize('entity'), [],
                'Usuário alterado com sucesso!');
        });
    }

    public function delete()
    {
        return $this->execute(function () {
            $this->entity = $this->findById($this->getValue('id'));
            $this->entity->delete();
            db()->persist($this->entity);
            db()->flush();
            db()->commit();
            return ApiResponseBag::success(null, [], 'Usuário removido com sucesso!');
        });
    }

    public function selectOne()
    {
        return $this->execute(function () {
            $this->entity = $this->findById($this->getValue('id'));
            return ApiResponseBag::success(
                $this->entity->normalize(['entity', 'relations'])
            );

        }, false);
    }

    public function selectMany(int $type = RewardTypes::REWARD): JsonResponse
    {
        return $this->execute(function () use ($type) {
            $result = $this->search($type);
            return ApiResponseBag::success($result);
        }, false);
    }

    private function search(): array
    {
        $qb = $this->createQueryBuilderEx('u')->notTrashed();

        $qb->isearch(['u.username', 'u.email', 'u.name'], $this->payload);



        $qb->excludedId($this->getValue('noId'), 'u');

        $qb->orderBy('u.name');
        return $qb->paginate($this->payload, Users::gr(['entity', 'relations']));
    }

    /**
     * @throws \Doctrine\ORM\ORMException
     */
    private function deserialize(): void
    {
        // dd($this->payload);
        $this->deserializer($this->payload, Users::class, Users::gw(), $this->entity);

        //$this->entity->setBuilding(Building::ref($this->getValue('building.id')));
        // dd($this->entity->normalize(['entity']));
    }
}
