<?php


namespace App\Controller\Web\Person;


use App\Controller\BaseController;
use App\Entity\Person;
use App\Entity\PersonIndividual;
use App\Util\ApiResponseBag;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class PersonRepositoryController
 * @package App\Controller\Web\Person
 * @Route(path="/api/web/person/repository")
 */
class PersonRepositoryController extends BaseController
{
    public function findByCpfCnpj (Request $request)
    {
        $data = $this->getData($request, func_get_args(), __FUNCTION__);

        $repo = db()->getRepository(\App\Entity\Person::class);
        $person = $repo->findOneByCpfCnpj($data['cpfCnpj']);
        $serialize = $this->normalize($person, Person::gr(['enity', 'person_individual'], PersonIndividual::gr('entity')));
    }
}
