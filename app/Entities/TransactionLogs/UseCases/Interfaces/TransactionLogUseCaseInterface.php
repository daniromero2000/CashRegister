<?php

namespace App\Entities\TransactionLogs\UseCases\Interfaces;

/**
 * Interface TransactionLogUseCaseInterface
 * @package App\Entities\TransactionLogs\UseCases\Interfaces
 */
interface TransactionLogUseCaseInterface
{
    /**
     * @return array
     */
    public function listTransactionLog():array;

    /**
     * @param string $date
     * @return array
     */
    public function getTransactionLogsByDate(string $date): array;
}
