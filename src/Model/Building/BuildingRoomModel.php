<?php


namespace App\Model\Building;

use App\Entity\Building;
use App\Entity\BuildingRoom;
use App\Entity\BuildingRoomType;
use App\Model\Base\BaseModel;
use App\Model\Base\IBaseModel;
use App\Util\ApiResponseBag;

/**
 * Class BuildingRoomModel
 * @package App\Model
 * @property BuildingRoom $entity
 */
class BuildingRoomModel extends BaseModel implements IBaseModel
{
    public function __construct(array $payload = null)
    {
        $this->payload = $payload;
        $this->entity = new BuildingRoom();
        $this->entityName = BuildingRoom::class;
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
                $this->entity->normalize(['entity', 'relations']), [],
                'Sala adicionada com sucesso.'
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
                'Sala alterada com sucesso!');
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
            return ApiResponseBag::success(null, [], 'Sala removida com sucesso!');
        });
    }

    private function search()
    {
        $qb = $this->createQueryBuilderEx('br')->notTrashed();

        $qb->isearch([
            'like' => ['br.name', 'br.reducedName', 'br.roomCode'],
            'eq' => ['br.floor', 'br.capacity']
        ], $this->payload);

        // $qb->excludedGuid($this->getValue('notId'), 'br');

        $qb->orderBy('br.name');
        return $qb->paginate($this->payload, BuildingRoom::gr(['entity', 'relations']));
    }

    /**
     * @throws \Doctrine\ORM\ORMException
     */
    private function deserialize(): void
    {
        $this->deserializer($this->payload, BuildingRoom::class, BuildingRoom::gw(), $this->entity);

        $this->entity->setBuilding(Building::ref($this->getValue('building.id')));
        $this->entity->setBuildingRoomType(BuildingRoomType::ref($this->getValue('buildingRoomType.id')));
    }
}
