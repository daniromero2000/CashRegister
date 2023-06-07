<?php

namespace App\Http\V1\Controllers\CashRegisters;

use App\Deserializers\CashRegister\CreateMoneyBaseDeserializer;
use App\Http\V1\Requests\CreateCashRegisterRequest;
use App\Http\V1\Responses\GeneralErrorResponse;
use App\UseCases\Interfaces\CashRegisters\CreateMoneyBaseUseCaseInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Throwable;

/**
 * Class SaveMoneyBaseController
 * @package App\Http\Controllers\Api\CashRegisters
 * @author Daniel Romero - 123romerod@gmail.com
 */
class SaveMoneyBaseController extends Controller
{
    public function __construct(
        private CreateMoneyBaseDeserializer $createMoneyBaseDeserializer,
        private CreateMoneyBaseUseCaseInterface $createMoneyBaseUseCase,
        private GeneralErrorResponse $errorResponse
    )
    {
    }

    public function __invoke(CreateCashRegisterRequest $request): JsonResponse
    {
        try {
            $moneyBaseDTO = $this->createMoneyBaseDeserializer->deserialize($request->input());
            $response = $this->createMoneyBaseUseCase->handler($moneyBaseDTO);

            return response()->json($response);
        } catch (Throwable $t) {
            return $this->errorResponse->generalError();
        }
    }
}
