<?php

namespace App\Entities\CashRegisters\Repositories\Interfaces;

use App\Entities\CashRegisters\Exceptions\CreateCashRegisterErrorException;
use App\Entities\CashRegisters\CashRegister;

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

    /**
     * @param array $data
     * @return CashRegister
     */
    public function createOrUpdateCashRegister(array $data): CashRegister;

    /**
     * @return bool
     */
    public function setEmptyCashRegister(): bool;

}
