<?php


namespace App\Controller\Mobile\CompanyBranch;


use App\Controller\BaseController;
use App\Model\CompanyBranch\CompanyBranchModel;
use App\Model\TransactionRecord\TransactionRecordModel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CompanyBranchController
 * @package App\Controller\Mobile\CompanyBranch
 * @Route(path="/api/mobile/companybranch")
 */
class CompanyBranchController extends BaseController
{
    /**
     * @Route(path="/allcompanybranches/get", methods={"POST", "OPTIONS"})
     * @param Request $request
     * @return JsonResponse
     */
    public function getAllCompanyBranches(Request $request): JsonResponse
    {
        $data = getRequestData(__CLASS__, __FUNCTION__, $request, func_get_args());

        $companyBranch = new CompanyBranchModel($data);
        return $companyBranch->selectAllMobile();
    }
}

