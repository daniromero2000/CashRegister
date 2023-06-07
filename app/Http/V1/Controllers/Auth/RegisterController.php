<?php

namespace App\Http\V1\Controllers\Auth;

use App\Http\V1\Controllers\Controller;
use App\Http\V1\Requests\SignUpRequest;
use App\Http\V1\Responses\GeneralErrorResponse;
use App\UseCases\Interfaces\Users\RegisterUserUseCaseInterface;
use Illuminate\Http\JsonResponse;
use Throwable;

/**
 * Class RegisterController
 * @package App\Http\Controllers\Api
 * @author Daniel Romero - 123romerod@gmail.com
 */
class RegisterController extends Controller
{
    public function __construct(
        private RegisterUserUseCaseInterface $registerUserUseCase,
        private GeneralErrorResponse $errorResponse
    )
    {
    }

    /**
     * @param SignUpRequest $request
     * @return JsonResponse
     */
    public function __invoke(SignUpRequest $request): JsonResponse
    {
        try {
            $response = $this->registerUserUseCase->handler([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password'))
            ]);

            return response()->json($response);
        } catch (Throwable $t) {
            return $this->errorResponse->generalError();
        }
    }
}
