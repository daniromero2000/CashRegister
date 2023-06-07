<?php

namespace App\Http\V1\Controllers\Payments;

use App\Deserializers\Payments\CreatePaymentDeserializer;
use App\Http\V1\Responses\GeneralErrorResponse;
use App\UseCases\Interfaces\Payments\SavePaymentUseCaseInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Throwable;

/**
 * Class SavePaymentController
 * @package App\Http\Controllers\Api\Payments
 * @author Daniel Romero - 123romerod@gmail.com
 */
class SavePaymentController extends Controller
{
    public function __construct(
        private CreatePaymentDeserializer $createPaymentDeserializer,
        private SavePaymentUseCaseInterface $savePaymentUseCase,
        private GeneralErrorResponse $errorResponse
    )
    {
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'amount_received' => 'required|integer',
            'amount' => 'in:100000,50000,20000,10000,5000,1000,500,200,100,50|required|integer',
            'denomination' => 'required|in:coin,bill'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 422);
        }

        try {
            $paymentDTO = $this->createPaymentDeserializer->deserialize($request->input());
            $response = $this->savePaymentUseCase->handler($paymentDTO);

            return response()->json($response, 200);
        } catch (Throwable $th) {
            return $this->errorResponse->generalError();
        }
    }
}
