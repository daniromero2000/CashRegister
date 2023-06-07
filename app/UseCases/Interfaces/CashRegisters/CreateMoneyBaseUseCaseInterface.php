<?php

namespace App\UseCases\Interfaces\CashRegisters;

use App\DataTransferObjects\CashRegister\CreateMoneyBaseDTO;

/**
 * Interface CreateMoneyBaseUseCaseInterface
 * @package App\UseCases\Interfaces\CashRegisters
 */
interface CreateMoneyBaseUseCaseInterface
{
    public function handler(CreateMoneyBaseDTO $createMoneyBaseDTO): array;
}
