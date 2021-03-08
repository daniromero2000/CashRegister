<?php

namespace App\Entities\TransactionLogs\UseCases;

use App\Entities\TransactionLogs\Repositories\Interfaces\TransactionLogRepositoryInterface;
use App\Entities\TransactionLogs\UseCases\Interfaces\TransactionLogUseCaseInterface;

/**
 * Class TransactionLogUseCase
 * @package App\Entities\TransactionLogs\UseCases
 * @author Daniel Romero - 123romerod@gmail.com
 */
class TransactionLogUseCase implements TransactionLogUseCaseInterface
{
    /**
     * @var TransactionLogRepositoryInterface
     */
    protected $transactionLogInterface;

    /**
     * TransactionLogUseCase constructor.
     * @param TransactionLogRepositoryInterface $transactionLogRepositoryInterface
     */
    public function __construct(TransactionLogRepositoryInterface $transactionLogRepositoryInterface)
    {
        $this->transactionLogInterface = $transactionLogRepositoryInterface;
    }

    /**
     * @return array
     */
    public function listTransactionLog(): array
    {
        $listLogs = $this->transactionLogInterface->listTransactionLogs();

        if (empty($listLogs->toArray())) {
            return ['status' => false, 'message' => 'empty'];
        }

        $data = [];

        foreach ($listLogs as $key => $listLog) {
            $data[$key] = [
                'type'  => $listLog->type,
                'value' => $listLog->value
            ];

            foreach ($listLog->cashRegister as $cashRegister) {
                $data[$key]['movements'][] = [
                    'value'            => $cashRegister->value,
                    'quantity'         => $cashRegister->pivot->cash_register_quantity,
                    'total'            => $cashRegister->value * $cashRegister->pivot->cash_register_quantity,
                    'denomination'     => $cashRegister->denomination,
                    'date_of_movement' => $cashRegister->created_at->toDateTimeString(),
                ];
            }
        }

        return ['status' => true, 'message' => $data];
    }

    /**
     * @param string $date
     * @return array
     */
    public function getTransactionLogsByDate(string $date): array
    {
        $listLogs = $this->transactionLogInterface->getTransactionLogsByDate($date, ['id', 'value', 'type']);

        if (empty($listLogs)) {
            return ['status' => false, 'message' => 'empty'];
        }

        $totalCashRegister = 0;

        foreach ($listLogs as $listLog) {
            if($listLog['type'] == 'cash_back'){
                $totalCashRegister -= $listLog['value'];
            }
            $totalCashRegister += $listLog['value'];
        }

        return ['status' => true, 'message' => ['total_cash_register' => $totalCashRegister]];
    }
}
