<?php

namespace App\Controller;

use App\Entity\Fidelity\Account;
use App\Model\Account\AccountModel;
use App\Model\Partner\PartnerModel;
use App\Model\Product\PaymentTypeModel;
use App\Model\Product\ProductModel;
use App\Model\Reward\RewardModel;
use App\Model\Reward\UsersModel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AndreControllerTestController extends AbstractController
{
    /**
     * @Route("/app/andre/test", name="andre_controller_test", methods={"GET"})
     */
    public function index()
    {
        // dd(User::get());
//        $m = new  PaymentTypeModel([
//            "id" => "e70c381f-1e5a-47ef-96c7-a94b8eb5b7a7",
//            "name" => "Cartao de Crédito ahhaha",
//            "altNames" => "VISA, MASTER, CIELO, VR",
//            "paymentTypeCompanyBranch" => [
//                [
//                    "paymentType" => null,
//                    "companyBranch" => [
//                        "id" => "36c001a7-b071-403f-b44e-691b3d9eb343",
//                        "name" => "CONTORNO 1",
//                        "legalName" => "Conrad LTDA"
//                    ],
//                    "tax" => "1.12345",
//                    "active" => false,
//                    "id" => "7597f4c1-dbc1-41b6-9a69-695d7dd53237"
//                ],
//                [
//                    "paymentType" => null,
//                    "companyBranch" => [
//                        "id" => "9f07e05d-8886-4c95-a998-ed77cce7a78e",
//                        "name" => "CONTORNO 2",
//                        "legalName" => "Dunapetrol"
//                    ],
//                    "tax" => "-2.54321",
//                    "active" => false,
//                    "id" => "14bd6b49-a990-4339-9237-563eeab7df7d"
//                ]
//            ]
//        ]);
//        return $m->update();
        // $repo = db()->getRepository(PaymentType::class);
        // $um  = $repo->createQueryBuilder('pt')
        //->leftJoin('pt.paymentTypeCompanyBranch', 'ptcb')->addSelect('ptcb')
        // ->getQuery()->getResult();

        return (new PartnerModel(['search'=>'']))->selectMany();
        // dd(PaymentType::gr(['relations', 'entity'], PaymentTypeCompanyBranch::gr()));
        // return new JsonResponse(Serializer::normalizeCollection($um,PaymentType::gr(['relations', 'entity'], PaymentTypeCompanyBranch::gr())));
    }
}
