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
            $cashRegister = $this->cashRegisterInterface->createCashRegister($data);
            $log = $this->transactionLogInterface->createTransactionLog(
                [
                    'type' => 'load_base',
                    'value' => $cashRegister->value
                ]);

            $cashRegister->transactionLogs()->attach($log,
                [
                    'cash_register_quantity' => $cashRegister->quantity,
                    'user_id' => auth()->user()->id
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
            'total_coin' => [],
            'coin' => [],
            'total_bill' => [],
            'bill' => []
        ];

        $listCashRegister = $this->cashRegisterInterface->listCashRegisters();

        foreach ($listCashRegister as $cashRegister) {
            $data['total_cash_register'] += $cashRegister['value'] * $cashRegister['quantity'];
            $data[$cashRegister['denomination']][] = ['value' => $cashRegister['value'], 'quantity' => $cashRegister['quantity']];
        }

        dd($data);

        return ['status' => true, 'message' => $data];
    }

    /**
     * @return array
     */
    public function withdrawAllMoney(): array
    {
        try{
            $response = $this->cashRegisterInterface->setEmptyCashRegister();
            if($response){
                return ['status' => true, 'message' => 'success'];
            }

            return ['status' => false, 'message' => 'error'];
        }catch (\Exception $e){
            return ['status' => false, 'message' => $e->getMessage()];
        }

    }
}
