<?php

namespace App\Http\Controllers\Api\CashRegisters;

use App\Http\Requests\CreateCashRegisterRequest;
use App\UseCases\Interfaces\CashRegisters\CashRegisterUseCaseInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

/**
 * Class CashRegisterController
 * @package App\Http\Controllers\Api\CashRegisters
 * @author Daniel Romero - 123romerod@gmail.com
 */
class CashRegisterController extends Controller
{
    /**
     * @var CashRegisterUseCaseInterface
     */
    protected $cashRegisterInterface;

    /**
     * CashRegisterController constructor.
     * @param CashRegisterUseCaseInterface $cashRegisterUseCaseInterface
     */
    public function __construct(CashRegisterUseCaseInterface $cashRegisterUseCaseInterface )
    {
        $this->cashRegisterInterface = $cashRegisterUseCaseInterface;
    }

    /**
     * @param CreateCashRegisterRequest $createCashRegisterRequest
     * @return JsonResponse
     */
    public function createMoneyBaseCashRegister(CreateCashRegisterRequest $createCashRegisterRequest): JsonResponse
    {
        $response = $this->cashRegisterInterface->createMoneyBase($createCashRegisterRequest->input());

        if(!$response['status']){
            return response()->json($response, 500);
        }

        return response()->json($response, 200);
    }

    /**
     * @return JsonResponse
     */
    public function checkStatusCashRegister(): JsonResponse
    {
        $response = $this->cashRegisterInterface->checkStatus();

        return response()->json($response, 200);
    }

    /**
     * @return JsonResponse
     */
    public function withdrawAllMoneyCashRegister(): JsonResponse
    {
        $response = $this->cashRegisterInterface->withdrawAllMoney();

        if(!$response['status']){
            return response()->json($response, 500);
        }

        return response()->json($response, 200);
    }
}
