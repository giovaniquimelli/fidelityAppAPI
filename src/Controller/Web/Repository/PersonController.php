<?php


namespace App\Controller\Web\Repository;


use App\Controller\BaseController;
use App\Entity\Person;
use App\Entity\PersonIndividual;
use App\Exception\ItemNotFoundException;
use App\Util\ApiResponseBag;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class PersonController
 * @package App\Controller\Web\Repository
 * @Route(path="api/web/repo/person/")
 */
class PersonController extends BaseController
{
    /**
     * @param Request $request
     * @return JsonResponse
     * @Route(path="get-person-individual-by-cpf-type", methods={"POST","OPTIONS"})
     */
    public function getPersonIndividualByCpfAndType(Request $request)
    {
        $data = $this->getData($request, func_get_args(), __FUNCTION__);
        $groups = Person::gr(['entity', 'person_individual'], PersonIndividual::gr('entity'));
        $repo = db()->getRepository(Person::class);
        $exist = $repo->findPersonTypeByCpf($data['cpfCnpj'], $data['type']);
        if($exist) {
            $person = $repo->findOneByCpfCnpj($data['cpfCnpj']);
            $serialized = $this->normalize($person, $groups);
            return ApiResponseBag::success($serialized)->getResponse();
        }
        return ApiResponseBag::fail(new ItemNotFoundException())->getResponse();
    }
}
