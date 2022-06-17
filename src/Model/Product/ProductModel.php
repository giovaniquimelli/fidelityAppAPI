<?php


namespace App\Model\Product;

use App\Entity\Fidelity\CompanyBranch;
use App\Entity\Fidelity\Product;
use App\Entity\Fidelity\ProductCompanyBranch;
use App\Model\Base\BaseModel;
use App\Model\Base\IBaseModel;
use App\Util\ApiResponseBag;
use App\Util\Container\Serializer;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class ProductModel
 * @package App\Model
 * @property Product $entity
 */
class ProductModel extends BaseModel implements IBaseModel
{
    public function __construct(array $payload = null)
    {
        $this->payload = $payload;
        $this->entity = new Product();
        $this->entityName = Product::class;
    }

    public function create()
    {
        return $this->execute(function () {
            $this->deserialize();
            db()->persist($this->entity);
            db()->flush();
            $id=$this->entity->getId();

            $filiais = [];
            $companyBranches = db()->getRepository(CompanyBranch::class)->findAll();
            foreach ($companyBranches as $cb) {
                $filiais[] = (new ProductCompanyBranch())
                    ->setCompanyBranch($cb)
                    ->setProduct($this->entity)
                    ->setActive(true)
                    ->setActive($this->entity->isActive());
            }

            /** @var ProductCompanyBranch $filial */
            foreach ($filiais as $filial) {
                db()->persist($filial);
                db()->flush();
            }

            db()->commit();
            return ApiResponseBag::success(
                $this->entity->normalize(['entity', 'relations']), [],
                'Prédio adicionado com sucesso.'
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

            /** @var ProductCompanyBranch[] $filiais */
            $filiais = Serializer::denormalizeCollection($this->getValue("productCompanyBranch"), ProductCompanyBranch::class);

            $q = db()->createQueryBuilder()->update(ProductCompanyBranch::class, 'p')
                ->set('p.quantity', ':quantity')
                ->set('p.point', ':point')
                ->set('p.price', ':price')
                ->set('p.paymentTypeFee', ':tax')
                ->set('p.active', ':active')
                ->where('p.id = :id');

            foreach ($filiais as $filial) {
                $q->setParameter('quantity', $filial->getQuantity())
                    ->setParameter('point', $filial->getPoint())
                    ->setParameter('price', $filial->getPrice())
                    ->setParameter('tax', $filial->isPaymentTypeFee())
                    ->setParameter('active', $filial->isActive())
                    ->setParameter('id', $filial->getId());
                //$qb->resetDQLParts()
                $p = $q->getQuery()->execute();
            }
            db()->commit();
            return ApiResponseBag::success(
                $this->entity->normalize('entity'), [],
                'Produto alterado com sucesso!');
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
            return ApiResponseBag::success(null, [], 'Prédio removido com sucesso!');
        });
    }

    public function selectOne()
    {
        return $this->execute(function () {
            $this->entity = $this->findById($this->getValue('id'));
            return ApiResponseBag::success(
                $this->entity->normalize(['entity', 'relations'], ProductCompanyBranch::gr(['entity', 'company_branch']))
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
        $qb = $this->createQueryBuilderEx('p')->notTrashed();

        $qb->isearch(['p.name', 'p.altNames'], $this->payload);

        $qb->excludedId($this->getValue('noId'), 'p');

        $qb->orderBy('p.name');
        return $qb->paginate($this->payload, Product::gr(['entity', 'relations']));
    }

    /**
     * @throws \Doctrine\ORM\ORMException
     */
    private function deserialize(): void
    {
        // dd($this->payload);
        $this->deserializer($this->payload, Product::class, Product::gw(), $this->entity);

        //$this->entity->setBuilding(Building::ref($this->getValue('building.id')));
        // dd($this->entity->normalize(['entity']));
    }
}
