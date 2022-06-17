<?php


namespace App\Util;


use App\Exception\ApiExceptionInterface;
use Error;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ApiGatewayResolver
{
    public static function resolve(Request $request)
    {
        $assoc = json_decode($request->getContent(), true);

        $returnArray = [];
        foreach ($assoc as $key => $value) {
            try {
                $returnArray[$key] = self::resolveRoute($value['route'], $value['data'], $request);
            } catch (\Throwable $e) {
                $response = null;
                $interfaces = array_keys(class_implements($e));

                if (in_array(ApiExceptionInterface::class, $interfaces, true)) {
                    // $statusCode = $e->getStatusCode();
                    $response = ApiResponseBag::fail($e);
                } else if ($e instanceof HttpException) {
                    // $statusCode = $e->getStatusCode();
                    $response = ApiResponseBag::error($e);
                } else {
                    $response = ApiResponseBag::unknownError($e);
                }

                $returnArray[$key] = $response;
            }
        }
        return ApiResponseBag::success($returnArray);
    }


    /**
     * @param string $name
     * @param array $jsonData
     * @param Request $request
     * @return JsonResponse
     */
    private static function resolveRoute(string $name, array $jsonData, Request $request)
    {
        $route = container('router')->getRouteCollection()->get($name);

        if ($route === null) {
            return null;
        }

        /** @var object|array|string|int|float $retorno */
        $retorno = call_user_func($route->getDefault('_controller'), $request, $jsonData);


        if ($retorno instanceof JsonResponse || $retorno instanceof Response) {
            $retorno = json_decode($retorno->getContent(), true);
        }

        return $retorno;
    }
}
