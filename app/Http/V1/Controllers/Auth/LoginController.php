<?php

namespace App\Http\V1\Controllers\Auth;

use App\Http\V1\Controllers\Controller;
use App\Http\V1\Requests\LoginRequest;
use App\Http\V1\Responses\Users\LoginErrorResponse;
use App\UseCases\Interfaces\Users\LoginUseCaseInterface;
use Illuminate\Http\JsonResponse;

/**
 * Class LoginController
 * @package App\Http\V1\Controllers\Auth
 * @author Daniel Romero - 123romerod@gmail.com
 */
class LoginController extends Controller
{
    public function __construct(
        private LoginUseCaseInterface $loginUseCase,
        private LoginErrorResponse $errorResponse
    )
    {
    }

    /**
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function __invoke(LoginRequest $request): JsonResponse
    {
        try {
            $response = $this->loginUseCase->handler(
                $request->input('email'),
                $request->input('password')
            );

            return response()->json($response);
        } catch (\Throwable $th) {
            return $this->errorResponse->handle($th);
        }
    }
}

