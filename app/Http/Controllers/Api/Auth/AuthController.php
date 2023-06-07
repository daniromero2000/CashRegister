<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignUpRequest;
use App\UseCases\Interfaces\Users\UserUseCaseInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class AuthController
 * @package App\Http\Controllers\Api
 * @author Daniel Romero - 123romerod@gmail.com
 */
class AuthController extends Controller
{
    /**
     * @var UserUseCaseInterface
     */
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
        return $this->userUseCase->createUser([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password)
        ]);
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
