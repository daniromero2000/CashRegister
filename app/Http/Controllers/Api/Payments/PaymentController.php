<?php

namespace App\Http\Controllers\Api\Payments;

use App\UseCases\Interfaces\Payments\PaymentUseCaseInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

/**
 * Class PaymentController
 * @package App\Http\Controllers\Api\Payments
 * @author Daniel Romero - 123romerod@gmail.com
 */
class PaymentController extends Controller
{
    /**
     * @var PaymentUseCaseInterface
     */
    protected $paymentInterface;

    /**
     * PaymentController constructor.
     * @param PaymentUseCaseInterface $paymentUseCaseInterface
     */
    public function __construct(PaymentUseCaseInterface $paymentUseCaseInterface)
    {
        $this->paymentInterface = $paymentUseCaseInterface;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function createPayment(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'customer_payment' => 'required|integer',
            'amount_payable' => 'in:100000,50000,20000,10000,5000,1000,500,200,100,50|required|integer',
            'payment_denomination' => 'required|in:coin,bill'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 422);
        }

        $response = $this->paymentInterface->createPayment($request->input());

        if(!$response['status']){
            return response()->json($response, 500);
        }
        return response()->json($response, 200);
    }
}
