<?php

namespace App\Http\V1\Responses\Users;

use App\Exceptions\Users\UserNotFoundException;
use App\Http\V1\Responses\GeneralErrorResponse;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class LoginErrorResponse extends GeneralErrorResponse
{
    private array $awareOf = [
        UserNotFoundException::class => 'userNotFound',
    ];

    /**
     * @param Throwable $throwable
     * @return JsonResponse
     * @see userNotFound
     */
    public function handle(Throwable $throwable): JsonResponse
    {
        $className = get_class($throwable);

        if (! in_array($className, array_keys($this->awareOf))) {
            return $this->generalError();
        }

        return $this->{$this->awareOf[$className]}($throwable);
    }

    /**
     * @return JsonResponse
     */
    private function userNotFound(): JsonResponse
    {
        return response()->json([
            'title' => self::TITLE_ERROR,
            'code' => 'INVALID_CREDENTIALS_ERROR',
            'detail' => 'Credenciales inválidas',
            'status' => Response::HTTP_BAD_REQUEST
        ], Response::HTTP_BAD_REQUEST);
    }
}
