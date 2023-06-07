<?php

namespace App\Http\V1\Controllers\Auth;

use App\Http\V1\Controllers\Controller;
use App\Http\V1\Responses\GeneralErrorResponse;
use App\UseCases\Interfaces\Users\UserUseCaseInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

/**
 * Class AuthController
 * @package App\Http\Controllers\Api
 * @author Daniel Romero - 123romerod@gmail.com
 */
class LogoutController extends Controller
{
    public function __construct(
        private UserUseCaseInterface $useCase,
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
        try {
            return response()->json($this->useCase->logout());
        } catch (Throwable $t) {
            return $this->errorResponse->generalError();
        }
    }
}
