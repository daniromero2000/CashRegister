<?php

namespace App\Entities\Users\UseCases;

use App\Entities\Users\Repositories\Interfaces\UserRepositoryInterface;
use App\Entities\Users\UseCases\Interfaces\UserUseCaseInterface;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class UserUseCase implements UserUseCaseInterface
{
    /**
     * @var UserRepositoryInterface
     */
    protected $userInterface;

    /**
     * UserUseCase constructor.
     * @param UserRepositoryInterface $userRepositoryInterface
     */
    public function __construct(UserRepositoryInterface $userRepositoryInterface)
    {
        $this->userInterface = $userRepositoryInterface;
    }

    /**
     * @param array $data
     * @return JsonResponse
     */
    public function createUser(array $data): JsonResponse
    {
        $this->userInterface->createUser($data);

        return response()->json([
            'message' => __('auth.create_user')
        ], 201);
    }

    public function loginUser(array $data): JsonResponse
    {
        if (!Auth::attempt($data)) {
            return response()->json([
                'message' => __('auth.unauthorized')
            ], 401);
        }

        $user = request()->user();
        $tokenResult = $user->createToken('Personal Access Token');

        $token = $tokenResult->token;
        $token->expires_at = Carbon::now()->add('hour', 8);
        $token->save();

        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse($token->expires_at)->toDateTimeString()
        ]);
    }

    /**
     * @return JsonResponse
     */
    public function logoutUser(): JsonResponse
    {
        $user = auth()->guard('api')->user();

        if (!$user) {
            return response()->json([
                'message' => __('auth.unauthenticated')
            ]);
        }

        auth()->guard('api')->user()->token()->revoke();

        return response()->json([
            'message' => __('auth.logout')
        ]);
    }
}
