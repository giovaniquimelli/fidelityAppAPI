<?php


namespace App\Model\Building;

use App\Entity\BuildingRoom;
use App\Entity\BuildingRoomType;
use App\Model\Base\BaseModel;
use App\Model\Base\IBaseModel;
use App\Util\ApiResponseBag;

/**
 * Class BuildingRoomModel
 * @package App\Model
 * @property BuildingRoomType $entity
 */
class BuildingRoomTypeModel extends BaseModel implements IBaseModel
{
    public function __construct(array $payload = null)
    {
        $this->payload = $payload;
        $this->entity = new BuildingRoomType();
        $this->entityName = BuildingRoomType::class;
    }

    public function selectOne()
    {
        return $this->execute(function () {
            $this->entity = $this->findById($this->getValue('id'));
            return ApiResponseBag::success(
                $this->entity->normalize('entity')
            );
        }, false);
    }

    public function selectMany()
    {
        return $this->execute(function () {
            $result = $this->search();
            return ApiResponseBag::success($result);
        }, false);
    }

    public function create()
    {

        return $this->execute(function () {
            $this->deserialize();
            db()->persist($this->entity);
            db()->flush();
            db()->commit();
            return ApiResponseBag::success(
                $this->entity->normalize('entity'), [],
                'Tipo de sala adicionado com sucesso.'
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
                'Tipo de sala alterado com sucesso!');
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
            return ApiResponseBag::success(null, [], 'Tipo de Sala removido com sucesso!');
        });
    }

    private function search()
    {
        $qb = $this->createQueryBuilderEx('brt')->notTrashed();

        $qb->isearch(['brt.name'], $this->payload);

        $qb->excludedId($this->getValue('notId'), 'brt');

        $qb->orderBy('brt.name');
        return $qb->paginate($this->payload, BuildingRoomType::gr('entity'));
    }

    /**
     * @throws \Doctrine\ORM\ORMException
     */
    private function deserialize(): void
    {
        $this->deserializer($this->payload, BuildingRoomType::class, BuildingRoomType::gw(), $this->entity);
    }
}
