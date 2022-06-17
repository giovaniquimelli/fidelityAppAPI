<?php


namespace App\Controller\Web\Repository;


use App\Controller\BaseController;
use App\Util\ApiResponseBag;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class Controller
 * @package App\Controller\Web\Repository
 * @Route(path="api/web/repo/const/")
 */
class ConstController extends BaseController
{
    /**
     * @Route(path="gender", methods={"GET", "OPTIONS"})
     * @param Request $request
     * @return JsonResponse
     */
    public function genders(Request $request): JsonResponse
    {
        return ApiResponseBag::success([
            ['id' => 'M', 'value' => 'MASCULINO'],
            ['id' => 'F', 'value' => 'FEMININO']
        ])->getResponse();
    }
}
