<?php


namespace App\Controller;


use App\Model\Authentication;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class BaseController
 * @package App\Controller
 */
class BaseController extends AbstractController
{

    /**
     * @param Request $request
     * @param array $args func_get_args() Runtime Arguments
     * @param string $fn __FUNCTION__ Method Name
     * @return array
     */
    protected function getData(Request $request, array $args, string $fn)
    {
        $className = static::class;
        $payload = [];

        try {
            $defaultParametersCount = (new \ReflectionMethod($className, $fn))->getNumberOfParameters();
            $calledParametersCount = count($args);
            $httpMethod = $request->getMethod();


            if ($defaultParametersCount < $calledParametersCount) {
                $payload = $args[$calledParametersCount - 1];

            } else {
                if ($httpMethod === 'POST' || $httpMethod === 'PUT') {
                    $payload = $request->getContent();
                } else {
                    // vem do ?var1=teste&var2=teste2 get / delete / head
                    $payload = $request->query->getIterator()->getArrayCopy();
                }
            }
        } catch (\Exception $ex) {
            // its almost impossible to get here
            // so, the exception wont be handled
            $payload = [];
        }

        return $payload;
    }

    protected function normalize($data, $groups = [], $context = [], $format = null)
    {
        return container_serializer_normalize($data, $groups, $context, $format);
    }
}
