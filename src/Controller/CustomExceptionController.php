<?php


namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class CustomExceptionController
 * @package App\Controller
 */
class CustomExceptionController
{
//    public function __construct(Environment $twig, bool $debug = true)
//    {
//        // parent::__construct($twig, $debug);
//    }

//    /**
//     * @Route(path="/api/custom/show", methods={"GET"}, name="api_custom_show")
//     */
    public function show() //, string $jsonData = null, bool $returnResponse = true)
    {

        return Response::create('e', 500);
//        $payload = null;
//        if($jsonData == null) {
//            $payload = $request->query->getIterator()->getArrayCopy();
//        } else {
//            $payload = json_decode($jsonData, true);
//        }
//
//        return parent::showAction($request, $exception, $logger); // TODO: Change the autogenerated stub
    }
}
