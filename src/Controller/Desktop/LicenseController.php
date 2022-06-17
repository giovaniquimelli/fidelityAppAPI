<?php


namespace App\Controller\Desktop;


use App\Controller\BaseController;
use App\Model\Account\AccountModel;
use App\Model\Product\ProductModel;
use App\Util\Crypto;
use App\Util\Str;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class LicenseController
 * @Route(path="/api/pos/licence")
 */
class LicenseController extends BaseController
{
    /**
     * @Route(path="/install", methods={"POST", "OPTIONS"})
     * @param Request $request
     * @return JsonResponse
     */
    public function install(Request $request): JsonResponse
    {
        $data = $request->getContent(); //$this->getData($request, func_get_args(), __FUNCTION__);

        dd(Crypto::decrypt($data));
    }

    /**
     * @Route(path="/refresh", methods={"POST", "OPTIONS"})
     * @param Request $request
     * @return JsonResponse
     */
    public function refresh(Request $request): JsonResponse
    {
        dd($request->getContent());
    }

    /**
     * @Route(path="/validate", methods={"POST", "OPTIONS"})
     * @param Request $request
     * @return JsonResponse
     */
    public function validate(Request $request): JsonResponse
    {
        dd($request->getContent());
    }

    /**
     * @Route(path="/invalidate", methods={"POST", "OPTIONS"})
     * @param Request $request
     * @return JsonResponse
     */
    public function invalidate(Request $request): JsonResponse
    {
        dd($request->getContent());
    }

    /**
     * @Route(path="/gen", methods={"POST", "OPTIONS"})
     * @param Request $request
     * @return JsonResponse
     */
    public function generateKey(Request $request): JsonResponse
    {
        $key = [
            'guid' => '9f07e05d-8886-4c95-a998-ed77cce7a78e',
            'url' => $_SERVER['SERVER_NAME'],
            'timeout' => (new \DateTime())->add(new \DateInterval('PT24H'))->format('Y-m-d h:i:s')
        ];
        return new JsonResponse(['key'=> Crypto::encrypt(json_encode($key))]);
    }
}