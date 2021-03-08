<?php

namespace App\Entities\CashRegisters\UseCases;

use App\Entities\CashRegisters\UseCases\Interfaces\CashRegisterUseCaseInterface;
use App\Entities\CashRegisters\Repositories\Interfaces\CashRegisterRepositoryInterface;
use App\Entities\TransactionLogs\Repositories\Interfaces\TransactionLogRepositoryInterface;

/**
 * Class CashRegisterUseCase
 * @package App\Entities\CashRegisters\
 * @author Daniel Romero - 123romerod@gmail.com
 */
class CashRegisterUseCase implements CashRegisterUseCaseInterface
{
    /**
     * @var CashRegisterRepositoryInterface
     */
    protected $cashRegisterInterface, $transactionLogInterface;

    /**
     * CashRegisterUseCase constructor.
     * @param CashRegisterRepositoryInterface $cashRegisterRepositoryInterface
     * @param TransactionLogRepositoryInterface $transactionLogRepositoryInterface
     */
    public function __construct(
        CashRegisterRepositoryInterface $cashRegisterRepositoryInterface,
        TransactionLogRepositoryInterface $transactionLogRepositoryInterface
    )
    {
        $this->cashRegisterInterface = $cashRegisterRepositoryInterface;
        $this->transactionLogInterface = $transactionLogRepositoryInterface;
    }

    /**
     * @param array $data
     * @return array
     */
    public function createMoneyBase(array $data): array
    {
        try {
            $cashRegister = $this->cashRegisterInterface->createOrUpdateCashRegister($data);

            $log = $this->transactionLogInterface->createTransactionLog(
                [
                    'type' => 'load_base',
                    'value' => $data['value']
                ]);

            $cashRegister->transactionLogs()->attach($log,
                [
                    'cash_register_quantity' => $data['quantity'],
                    'user_id' => auth()->user() ? auth()->user()->id : 1
                ]);

            return ['status' => true, 'message' => 'correcto'];
        } catch (\Exception $e) {
            return ['status' => false, 'message' => $e->getMessage()];
        }
    }

    /**
     * @return array
     */
    public function checkStatus(): array
    {
        $data = [
            'total_cash_register' => 0,
            'coin' => [],
            'total_coin' => 0,
            'bill' => [],
            'total_bill' => 0
        ];

        $listCashRegister = $this->cashRegisterInterface->listCashRegisters();

        foreach ($listCashRegister as $cashRegister) {
            $data['total_cash_register'] += $cashRegister['value'] * $cashRegister['quantity'];
            $data[$cashRegister['denomination']][] = ['value' => $cashRegister['value'], 'quantity' => $cashRegister['quantity']];
            $data['total_' . $cashRegister['denomination']] += $cashRegister['value'] * $cashRegister['quantity'];
        }

        return ['status' => true, 'message' => $data];
    }

    /**
     * @return array
     */
    public function withdrawAllMoney(): array
    {
        $response = $this->cashRegisterInterface->setEmptyCashRegister();
        if ($response) {
            return ['status' => true, 'message' => 'success'];
        }

        return ['status' => false, 'message' => 'error'];

    }
}
