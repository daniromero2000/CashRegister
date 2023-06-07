<?php

namespace App\Repositories\CashRegisters;

use App\Models\CashRegister;
use App\Repositories\Interfaces\CashRegisters\CashRegisterRepositoryInterface;

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
     * @param array $where
     * @return array
     */
    public function list(array $where = []): iterable
    {
        return $this->cashRegister
            ->when($where, function ($query, $where) {
                return $query->where($where['column'], $where['operator'], $where['value']);
            })
            ->orderBy('value', 'DESC')
            ->get();
    }

    /**
     * @param array $data
     * @return CashRegister
     */
    public function create(array $data): CashRegister
    {
        return $this->cashRegister->create($data);
    }

    /**
     * @param int $id
     * @param array $data
     * @return CashRegister
     */
    public function update(int $id, array $data): CashRegister
    {
        $model = $this->cashRegister->find($id);
        $model->update($data);

        return $model;
    }

    /**
     * @param array $data
     * @param string $operator
     * @return CashRegister
     */
    public function createOrUpdate(array $data, string $operator = 'sum'): CashRegister
    {
        $cashRegister = $this->cashRegister
            ->where('denomination', $data['denomination'])
            ->where('value', $data['value'])
            ->first();

        if ($cashRegister) {
            if ($operator == 'sum') {
                $quantity = $cashRegister->quantity + $data['quantity'];
            } else {
                $quantity = $cashRegister->quantity - $data['quantity'];
            }

            $cashRegister->update(['quantity' => $quantity]);
        } else {
            $cashRegister = $this->create($data);
        }

        return $cashRegister;
    }

    public function findByByDenominationAndValue(string $denomination, float $value): ?CashRegister
    {
        return $this->cashRegister
            ->where('denomination', $denomination)
            ->where('value', $value)
            ->first();
    }

    /**
     * @return bool
     */
    public function setEmptyCashRegister(): bool
    {
        return $this->cashRegister->where('quantity', '>', 0)
            ->update(['quantity' => 0]);
    }

}
