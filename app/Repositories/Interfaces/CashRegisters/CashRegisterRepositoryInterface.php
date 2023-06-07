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
     * @param array $where
     * @return array
     */
    public function list(array $where = []): iterable;

    /**
     * @param array $data
     * @return CashRegister
     */
    public function create(array $data): CashRegister;

    /**
     * @param int $id
     * @param array $data
     * @return CashRegister
     */
    public function update(int $id, array $data): CashRegister;

    /**
     * @param array $data
     * @param string $operator
     * @return CashRegister
     */
    public function createOrUpdate(array $data, string $operator = 'sum'): CashRegister;

    /**
     * @param string $denomination
     * @param float $value
     * @return CashRegister|null
     */
    public function findByByDenominationAndValue(string $denomination, float $value): ?CashRegister;

    /**
     * @return bool
     */
    public function setEmptyCashRegister(): bool;
}
