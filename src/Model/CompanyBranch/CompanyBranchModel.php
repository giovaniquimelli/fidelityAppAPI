<?php


namespace App\Model\CompanyBranch;

use App\Entity\Fidelity\CompanyBranch;
use App\Entity\Fidelity\Product;
use App\Model\Base\BaseModel;
use App\Model\Base\IBaseModel;
use App\Util\ApiResponseBag;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class CompanyBranchModel
 * @package App\Model
 * @property Product $entity
 */
class CompanyBranchModel extends BaseModel implements IBaseModel
{
    /** @var CompanyBranch[] */
    private $companyBranchList = [];

    public function __construct(array $payload = null)
    {
        $this->payload = $payload;
        $this->entity = new Product();
        $this->entityName = CompanyBranch::class;
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

    public function selectMany(): JsonResponse
    {
        return $this->execute(function () {
            $result = $this->search();
            return ApiResponseBag::success($result);
        }, false);
    }

    private function search(): array
    {
        $qb = $this->createQueryBuilderEx('c')->notTrashed();

        $qb->isearch(['c.name'], $this->payload);


        $qb->excludedId($this->getValue('noId'), 'c');

        $qb->orderBy('c.name');
        return $qb->paginate($this->payload, CompanyBranch::gr(['entity', 'relations']));
    }

    /**
     * @throws \Doctrine\ORM\ORMException
     */
    private function deserialize(): void
    {
        // dd($this->payload);
        $this->deserializer($this->payload, CompanyBranch::class, CompanyBranch::gw(), $this->entity);

        //$this->entity->setBuilding(Building::ref($this->getValue('building.id')));
        // dd($this->entity->normalize(['entity']));
    }

    public function selectAllMobile() {
        return $this->execute(function () {
            $repo = db()->getRepository($this->entityName);

            $this->companyBranchList = $repo->findBy([
                'deletedAt' => null,
                'statusCode' => 1
            ]);

            $value = CompanyBranch::normalizeCollection($this->companyBranchList, 'entity');
            return ApiResponseBag::success($value);
        }, false);
    }
}
