<?php

namespace App\Entities\TransactionLogs\Repositories\Interfaces;

use App\Entities\TransactionLogs\TransactionLog;

/**
 * Interface TransactionLogRepositoryInterface
 * @package App\Entities\TransactionLogs\Repositories\Interfaces
 */
interface TransactionLogRepositoryInterface
{
    /**
     * @param array|string[] $columns
     * @return array
     */
    public function listTransactionLogs(array $columns = ['*']): array;

    /**
     * @param array $data
     * @return TransactionLog
     */
    public function createTransactionLog(array $data): TransactionLog;

}
