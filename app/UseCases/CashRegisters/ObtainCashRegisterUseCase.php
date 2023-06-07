<?php


namespace App\UseCases\CashRegisters;


use App\Models\CashRegister;
use App\Repositories\Interfaces\CashRegisters\CashRegisterRepositoryInterface;
use App\Repositories\Interfaces\TransactionLogs\TransactionLogRepositoryInterface;

class ObtainCashRegisterUseCase
{
    public function __construct(
        private CashRegisterRepositoryInterface $cashRegisterRepository,
        private TransactionLogRepositoryInterface $transactionLogRepository
    )
    {
    }

    public function handler(array $data, string $operator = 'sum'): CashRegister
    {
        $existCashRegister = $this->cashRegisterRepository
            ->findByByDenominationAndValue(
                $data['denomination'],
                $data['value']
            );

        if ($existCashRegister) {
            $quantity = $this->getQuantity($data['quantity'], $existCashRegister->quantity, $operator);

            return $this->cashRegisterRepository->update(
                $existCashRegister->id,
                [
                    'quantity' => $quantity
                ]
            );
        }

        return $this->cashRegisterRepository->create($data);
    }

    private function getQuantity(int $quantity, int $currentQuantity, string $operator)
    {
        if ($operator == 'sum') {
            return $currentQuantity + $quantity;
        }

        return $currentQuantity - $quantity;
    }
}
