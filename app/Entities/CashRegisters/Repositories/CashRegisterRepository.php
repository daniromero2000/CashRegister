<?php

namespace App\Entities\Users\Entities\CashRegisters\Repositories;

use App\Entities\Users\Entities\CashRegisters\CashRegister;
use App\Entities\Users\Entities\CashRegisters\Repositories\Interfaces\CashRegisterRepositoryInterface;

/**
 * Class CashRegisterRepository
 * @package App\Entities\CashRegisters\Repositories
 * @author Daniel Romero - 123romerod@gmail.com
 */
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
