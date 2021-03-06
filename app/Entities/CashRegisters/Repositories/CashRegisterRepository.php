<?php

namespace App\Entities\CashRegisters\Repositories;

use App\Entities\CashRegisters\CashRegister;
use App\Entities\CashRegisters\Repositories\Interfaces\CashRegisterRepositoryInterface;

class CashRegisterRepository implements CashRegisterRepositoryInterface
{
    /**
     * @var CashRegister
     */
    protected $cashRegister;

    /**
     * CashRegisterRepository constructor.
     * @param CashRegister $cashRegister
     */
    public function __construct(CashRegister $cashRegister)
    {
        $this->cashRegister = $cashRegister;
    }

    /**
     * @param array|string[] $columns
     * @return array
     */
    public function listCashRegisters(array $columns = ['*']): array
    {
        return $this->cashRegister->get($columns);
    }

    /**
     * @param array $data
     * @return CashRegister
     */
    public function createCashRegister(array $data): CashRegister
    {
        return $this->cashRegister->create($data);
    }

}
