<?php

namespace App\Http\V1\Controllers\CashRegisters;

use App\Http\V1\Responses\GeneralErrorResponse;
use App\UseCases\Interfaces\CashRegisters\CheckStatusUseCaseInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Throwable;

/**
 * Class CheckStatusController
 * @package App\Http\Controllers\Api\CashRegisters
 * @author Daniel Romero - 123romerod@gmail.com
 */
class CheckStatusController extends Controller
{
    public function __construct(
        private CheckStatusUseCaseInterface $checkStatusUseCase,
        private GeneralErrorResponse $errorResponse
    )
    {
    }

    public function __invoke(): JsonResponse
    {
        try {
            $response = $this->checkStatusUseCase->handler();

            return response()->json($response);
        } catch (Throwable $t) {
            return $this->errorResponse->generalError();
        }
    }
}
