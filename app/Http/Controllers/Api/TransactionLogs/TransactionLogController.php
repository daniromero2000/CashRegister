<?php

namespace App\Http\Controllers\Api\TransactionLogs;

use App\Entities\TransactionLogs\UseCases\Interfaces\TransactionLogUseCaseInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

/**
 * Class TransactionLogController
 * @package App\Http\Controllers\Api\TransactionLogs
 * @author Daniel Romero - 123romerod@gmail.com
 */
class TransactionLogController extends Controller
{
    /**
     * @var TransactionLogUseCaseInterface
     */
    protected $transactionLogInterface;

    /**
     * TransactionLogController constructor.
     * @param TransactionLogUseCaseInterface $transactionLogUseCaseInterface
     */
    public function __construct(TransactionLogUseCaseInterface $transactionLogUseCaseInterface)
    {
        $this->transactionLogInterface = $transactionLogUseCaseInterface;
    }

    /**
     * @return JsonResponse
     */
    public function getLogs(): JsonResponse
    {
        $response = $this->transactionLogInterface->listTransactionLog();

        if (!$response['status']) {
            return response()->json($response, 500);
        }

        return response()->json($response, 200);
    }

    /**
     * @param $date
     * @return JsonResponse
     */
    public function getStatusByDate($date): JsonResponse
    {
        $response = $this->transactionLogInterface->getTransactionLogsByDate($date);

        if (!$response['status']) {
            return response()->json($response, 500);
        }

        return response()->json($response, 200);
    }
}
