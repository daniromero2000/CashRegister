<?php

namespace App\Http\V1\Responses;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class GeneralErrorResponse
{
    /**
     * Title of general error.
     */
    public const TITLE_ERROR = 'General error';

    /**
     * General error code.
     */
    public const GENERAL_ERROR = 'GENERAL_ERROR';

    /**
     * Detail error
     */
    public const DETAIL_ERROR = 'Un error inesperado ha ocurrido';

    /**
     * Http general business error.
     */
    public const HTTP_BUSINESS_ERROR = 280;

    /**
     * Http general business error in string.
     */
    public const HTTP_BUSINESS_ERROR_STRING = '280';

    /**
     * @return JsonResponse
     */
    public function generalError(): JsonResponse
    {
        return response()->json([
            'title' => self::TITLE_ERROR,
            'code' => self::GENERAL_ERROR,
            'detail' => self::DETAIL_ERROR,
            'status' => Response::HTTP_INTERNAL_SERVER_ERROR
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
