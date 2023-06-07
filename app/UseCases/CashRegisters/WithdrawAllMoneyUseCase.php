<?php

namespace App\UseCases\CashRegisters;

use App\Repositories\Interfaces\CashRegisters\CashRegisterRepositoryInterface;
use App\UseCases\Interfaces\CashRegisters\WithdrawAllMoneyUseCaseInterface;
use Exception;

/**
 * Class WithdrawAllMoneyUseCase
 * @package App\UseCases\CashRegisters
 */
class WithdrawAllMoneyUseCase implements WithdrawAllMoneyUseCaseInterface
{
    public function __construct(
        private CashRegisterRepositoryInterface $cashRegisterRepository,
    )
    {
    }

    public function handler(): array
    {
        $response = $this->cashRegisterRepository->setEmptyCashRegister();

        if (!$response) {
            throw new Exception('Error al intentar vacial la caja registradora.');
        }

        return ['status' => true, 'message' => 'success'];
    }
}
