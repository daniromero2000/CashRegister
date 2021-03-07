<?php


namespace App\Entities\CashRegisters\UseCases\Interfaces;


use App\Entities\CashRegisters\CashRegister;

interface CashRegisterUseCaseInterface
{
    /**
     * @param array $data
     * @return array
     */
    public function createMoneyBase(array $data): array;

    /**
     * @return array
     */
    public function checkStatus(): array;

    /**
     * @return array
     */
    public function withdrawAllMoney(): array;

}
