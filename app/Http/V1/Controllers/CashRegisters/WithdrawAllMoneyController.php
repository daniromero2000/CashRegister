<?php

namespace App\Http\V1\Controllers\CashRegisters;

use App\Http\V1\Responses\GeneralErrorResponse;
use App\UseCases\Interfaces\CashRegisters\CheckStatusUseCaseInterface;
use App\UseCases\Interfaces\CashRegisters\WithdrawAllMoneyUseCaseInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Throwable;

/**
 * Class WithdrawAllMoneyController
 * @package App\Http\Controllers\Api\CashRegisters
 * @author Daniel Romero - 123romerod@gmail.com
 */
class WithdrawAllMoneyController extends Controller
{
    public function __construct(
        private WithdrawAllMoneyUseCaseInterface $withdrawAllMoneyUseCase,
        private GeneralErrorResponse $errorResponse
    )
    {
    }

    public function __invoke(): JsonResponse
    {
        try {
            $response = $this->withdrawAllMoneyUseCase->handler();

            return response()->json($response);
        } catch (Throwable $t) {
            return $this->errorResponse->generalError();
        }
    }
}
