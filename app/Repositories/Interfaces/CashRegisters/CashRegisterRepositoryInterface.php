<?php

namespace App\Repositories\Interfaces\CashRegisters;

use App\Models\CashRegister;

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
    public function list(array $columns = ['*'], array $where = []): array;

    /**
     * @param array $data
     * @return CashRegister
     */
    public function create(array $data): CashRegister;

    /**
     * @param array $data
     * @param string $operator
     * @return CashRegister
     */
    public function createOrUpdate(array $data, string $operator = 'sum'): CashRegister;

    /**
     * @return bool
     */
    public function setEmptyCashRegister(): bool;
}
