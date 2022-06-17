<?php


namespace App\Model\Product;

use App\Entity\Fidelity\CompanyBranch;
use App\Entity\Fidelity\PaymentType;
use App\Entity\Fidelity\PaymentTypeCompanyBranch;
use App\Entity\Fidelity\Product;
use App\Model\Base\BaseModel;
use App\Model\Base\IBaseModel;
use App\Util\ApiResponseBag;
use App\Util\Container\Serializer;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class PaymentTypeModel
 * @package App\Model\Product
 * @property Product $entity
 */
class PaymentTypeModel extends BaseModel implements IBaseModel
{
    public function __construct(array $payload = null)
    {
        $this->payload = $payload;
        $this->entity = new PaymentType();
        $this->entityName = PaymentType::class;
    }

    public function create()
    {
        return $this->execute(function () {
            $this->deserialize();
            /** @var ArrayCollection $filiais */
            $filiais = [];

            db()->persist($this->entity);
            db()->flush();
            $id = $this->entity->getId();

            $companyBranches = db()->getRepository(CompanyBranch::class)->findAll();
            foreach ($companyBranches as $cb) {
                $filiais[] = (new PaymentTypeCompanyBranch())
                    ->setCompanyBranch($cb)
                    ->setPaymentType($this->entity)
                    ->setTax(0)
                    ->setActive($this->entity->isActive());

            }

            /** @var PaymentTypeCompanyBranch $filial */
            foreach ($filiais as $filial) {
                db()->persist($filial);
                db()->flush();
            }

            /** @var PaymentType $outro */
            $outro = $this->findById($id);
            $outro->setPaymentTypeCompanyBranch($filiais);

            db()->commit();

            return ApiResponseBag::success(
                $outro->normalize(['entity', 'relations'], PaymentTypeCompanyBranch::gr(['entity', 'company_branch'])), [],
                'Forma de pagamento adicionado com sucesso.'
            );
        });
    }

    public function update()
    {
        // dd($this->getValue("paymentTypeCompanyBranch"));
        return $this->execute(function () {
            $this->entity = $this->findById($this->getValue('id'));
            $this->deserialize();

            db()->persist($this->entity);
            db()->flush();

            /** @var PaymentTypeCompanyBranch[] $filiais */
            $filiais = Serializer::denormalizeCollection($this->getValue("paymentTypeCompanyBranch"), PaymentTypeCompanyBranch::class);

            $q = db()->createQueryBuilder()->update(PaymentTypeCompanyBranch::class, 'p')
                ->set('p.tax', ':tax')
                ->set('p.active', ':active')
                ->where('p.id = :id');
            foreach ($filiais as $filial) {
                $q->setParameter('tax', $filial->getTax())
                    ->setParameter('active', $filial->isActive())
                    ->setParameter('id', $filial->getId());
                //$qb->resetDQLParts()
                $p = $q->getQuery()->execute();
            }

            db()->commit();
            /** @var PaymentType $outro */
            $outro = $this->findById($this->getValue('id'));
            $normalized = $outro->normalize(['entity', 'relations']);
            $normalized['paymentTypeCompanyBranch'] = Serializer::normalizeCollection($filiais, PaymentTypeCompanyBranch::gr(['entity', 'company_branch']));
            return ApiResponseBag::success(
                $normalized, [],
                'Forma de Pagamento editada com sucesso!');
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
            return ApiResponseBag::success(null, [], 'Forma de Pagamento removida com sucesso!');
        });
    }

    public function selectOne(): JsonResponse
    {
        return $this->execute(function () {
            $this->entity = $this->findById($this->getValue('id'));
            return ApiResponseBag::success(
                $this->entity->normalize(['entity', 'relations'], PaymentTypeCompanyBranch::gr(['entity', 'company_branch']))
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
        // $qb->leftJoin('p.paymentTypeCompanyBranch', 'pcm')->addSelect('pcm');

        $qb->excludedId($this->getValue('noId'), 'p');

        $qb->orderBy('p.name');

        return $qb->paginate($this->payload, PaymentType::gr(['entity']));
    }

    /**
     * @throws \Doctrine\ORM\ORMException
     */
    private function deserialize(): void
    {
        $this->deserializer($this->payload, PaymentType::class, PaymentType::gw(), $this->entity);

        //$this->entity->setBuilding(Building::ref($this->getValue('building.id')));
        // dd($this->entity->normalize(['entity']));
    }
}
