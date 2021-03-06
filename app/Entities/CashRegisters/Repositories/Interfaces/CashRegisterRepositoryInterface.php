<?php

namespace App\Entities\CashRegisters\Repositories\Interfaces;

use App\Entities\CashRegisters\CashRegister;

/**
 * Interface CashRegisterRepositoryInterface
 * @package App\Entities\CashRegisters\Repositories\Interfaces
 */
interface CashRegisterRepositoryInterface
{
    /**
     * @param array|string[] $columns
     * @param array $where
     * @return array
     */
    public function listCashRegisters(array $columns = ['*'], array $where = []): array;

    /**
     * @param array $data
     * @return CashRegister
     */
    public function createCashRegister(array $data): CashRegister;

    /**
     * @param array $data
     * @param string $operator
     * @return CashRegister
     */
    public function createOrUpdateCashRegister(array $data, string $operator = 'sum'): CashRegister;

    /**
     * @return bool
     */
    public function setEmptyCashRegister(): bool;

}
