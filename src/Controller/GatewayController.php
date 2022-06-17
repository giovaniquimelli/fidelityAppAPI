<?php

namespace App\Controller;

use App\Doctrine\DB;
use App\Entity\Fidelity\CompanyBranch;
use App\Entity\Fidelity\Reward;
use App\Services\GatewayResolverService;
use App\Util\ApiGatewayResolver;
use App\Util\Container\Serializer;
use App\Util\Container\TokenGuard;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class GatewayController extends AbstractController
{
    /**
     * @Route(path="/app/gateway", methods={"POST", "OPTIONS"})
     * @param Request $request
     * @return JsonResponse
     */
    public function indexGatewayWeb(Request $request): JsonResponse
    {
        // $user = TokenGuard::token()->getUser();
        // dd($user);
        // return new JsonResponse(['route'=>'gateway', 'user' => $user->getUsername().'|'.$user->getEmail(), 'args'=>func_num_args()]);
        return GatewayResolverService::resolve($request)->getResponse();
    }

    /**
     * @Route(path="api/pos/gateway", methods={"POST", "OPTIONS"})
     * @param Request $request
     * @return JsonResponse
     */
    public function indexGatewayPos(Request $request): JsonResponse
    {
        return GatewayResolverService::resolve($request)->getResponse();
    }

    /**
     * @Route(path="/api/mobile/account/gateway", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function indexGatewayMobileAccount(Request $request): JsonResponse
    {
        //return JsonResponse::create(json_decode($request->getContent(), true));
        return ApiGatewayResolver::resolve($request)->getResponse();
    }

    /**
     * Use only for tests
     * @Route(path="/pagination", methods={"GET", "POST", "OPTIONS"})
     * @param Request $request
     * @return JsonResponse
     * @throws \Doctrine\DBAL\DBALException
     */
    public function pagination(Request $request): JsonResponse
    {

        $repo = db()->getRepository(Reward::class);

        $premios = $repo->findAllBranchesByRewardOrEmpty(new Reward, true);

        dd(json_encode(Serializer::normalizeCollection($premios, CompanyBranch::gr())));
        dd($premios);
    }


}
