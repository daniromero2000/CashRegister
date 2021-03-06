<?php

namespace App\Http\Controllers\Api\Auth;

use App\Entities\Users\Requests\LoginRequest;
use App\Entities\Users\Requests\SignUpRequest;
use App\Entities\Users\UseCases\Interfaces\UserUseCaseInterface;
use App\Http\Controllers\Controller;
use App\Entities\Users\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class AuthController
 * @package App\Http\Controllers\Api
 */
class AuthController extends Controller
{
    protected $userUseCase;

    public function __construct(UserUseCaseInterface $userUseCaseInterface)
    {
        $this->userUseCase = $userUseCaseInterface;
    }

    /**
     * @param SignUpRequest $request
     * @return JsonResponse
     */
    public function signUp(SignUpRequest $request): JsonResponse
    {
        return $this->userUseCase->createUser($request->input());
    }

    /**
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        return $this->userUseCase->loginUser(request(['email', 'password']));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        return $this->userUseCase->logoutUser();
    }
}
