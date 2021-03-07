<?php

namespace App\Entities\CashRegisters\Repositories;

use App\Entities\CashRegisters\CashRegister;
use App\Entities\CashRegisters\Exceptions\CreateCashRegisterErrorException;
use App\Entities\CashRegisters\Repositories\Interfaces\CashRegisterRepositoryInterface;
use Illuminate\Database\QueryException;

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
        $cashRegisterList = $this->cashRegister->get($columns);

        return (empty($cashRegisterList)) ? [] : $cashRegisterList->toArray();
    }

    /**
     * @param array $data
     * @return CashRegister
     */
    public function createCashRegister(array $data): CashRegister
    {
        return $this->cashRegister->create($data);
    }

    /**
     * @return bool
     */
    public function setEmptyCashRegister(): bool
    {
        return $this->cashRegister->where('quantity','>', 0)
            ->update(['quantity' => 0]);
    }

}
