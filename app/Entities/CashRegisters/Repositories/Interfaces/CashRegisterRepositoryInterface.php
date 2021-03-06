<?php

namespace App\Entities\Users\Entities\CashRegisters\Repositories\Interfaces;

use App\Entities\Users\Entities\CashRegisters\CashRegister;

/**
 * Interface CashRegisterRepositoryInterface
 * @package App\Entities\CashRegisters\Repositories\Interfaces
 */
interface CashRegisterRepositoryInterface
{
    /**
     * @param array|string[] $columns
     * @return array
     */
    public function listCashRegisters(array $columns = ['*']): array;

    /**
     * @param array $data
     * @return CashRegister
     */
    public function createCashRegister(array $data): CashRegister;
}
