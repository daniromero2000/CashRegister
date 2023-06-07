<?php

namespace App\UseCases\CashRegisters;

use App\Repositories\Interfaces\CashRegisters\CashRegisterRepositoryInterface;
use App\Repositories\Interfaces\TransactionLogs\TransactionLogRepositoryInterface;
use App\UseCases\Interfaces\CashRegisters\CheckStatusUseCaseInterface;

/**
 * Class CheckStatusUseCase
 * @package App\UseCases\CashRegisters
 */
class CheckStatusUseCase implements CheckStatusUseCaseInterface
{
    public function __construct(
        private CashRegisterRepositoryInterface $cashRegisterRepository,
        private TransactionLogRepositoryInterface $transactionLogRepository
    )
    {
    }

    public function handler(): array
    {
        $data = [
            'total_cash_register' => 0,
            'coin' => [],
            'total_coin' => 0,
            'bill' => [],
            'total_bill' => 0
        ];

        $list = $this->cashRegisterRepository->list();

        foreach ($list as $cashRegister) {
            $totalAmount = $cashRegister->value * $cashRegister->quantity;

            $data['total_cash_register'] += $totalAmount;

            $data[$cashRegister->denomination][] = [
                'value' => $cashRegister->value,
                'quantity' => $cashRegister->quantity
            ];

            $data['total_' . $cashRegister->denomination] += $totalAmount;
        }

        return [
            'status' => true,
            'message' => $data
        ];
    }
}
