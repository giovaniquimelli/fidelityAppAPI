<?php


namespace App\Services;


use App\Exception\ApiExceptionInterface;
use App\Util\ApiResponseBag;
use Error;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

class GatewayResolverService
{
    public static function resolve(Request $request): ApiResponseBag
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
        /** @var RouteCollection $routes */
        $routes = container('router')->getRouteCollection(); //->get($name);

        $route = null;

        /** @var Route $rt */
        foreach ($routes as $rt) {
            if ($rt->getPath() === '/api/web/' . $name) {
                $route = $rt;
                break;
            }
        }

        if ($route === null) {
            return null;
        }

        $names = explode('::', $route->getDefault('_controller'));

        $retorno = (new $names[0])->{$names[1]}($request, $jsonData);

        // /** @var object|array|string|int|float $retorno */
        // $retorno = call_user_func($route->getDefault('_controller'), $request, $jsonData);


        if ($retorno instanceof JsonResponse || $retorno instanceof Response) {
            $retorno = json_decode($retorno->getContent(), true);
        }

        return $retorno;
    }
}
