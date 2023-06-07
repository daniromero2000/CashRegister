<?php

namespace App\UseCases\CashRegisters;

use App\DataTransferObjects\CashRegister\CreateMoneyBaseDTO;
use App\Models\CashRegister;
use App\Repositories\Interfaces\CashRegisters\CashRegisterRepositoryInterface;
use App\Repositories\Interfaces\TransactionLogs\TransactionLogRepositoryInterface;
use App\UseCases\Interfaces\CashRegisters\CreateMoneyBaseUseCaseInterface;

/**
 * Class CreateMoneyBaseUseCase
 * @package App\UseCases\CashRegisters
 */
class CreateMoneyBaseUseCase implements CreateMoneyBaseUseCaseInterface
{
    public function __construct(
        private CashRegisterRepositoryInterface $cashRegisterRepository,
        private TransactionLogRepositoryInterface $transactionLogRepository,
        private ObtainCashRegisterUseCase $obtainCashRegisterUseCase
    )
    {
    }

    public function handler(CreateMoneyBaseDTO $createMoneyBaseDTO): array
    {
        $cashRegister = $this->obtainCashRegisterUseCase->handler($createMoneyBaseDTO->serialize());
        $this->saveLogs(
            $createMoneyBaseDTO->getValue(),
            $createMoneyBaseDTO->getQuantity(),
            $cashRegister
        );

        return [
            'status' => true,
            'message' => 'successfully loaded base'
        ];
    }

    private function saveLogs(float $value, int $quantity, CashRegister $cashRegister): void
    {
        $log = $this->transactionLogRepository->create(
            [
                'type' => 'load_base',
                'value' => $value
            ]);

        $cashRegister->transactionLogs()->attach($log,
            [
                'cash_register_quantity' => $quantity,
                'user_id' => auth()->user()->id
            ]);
    }
}
