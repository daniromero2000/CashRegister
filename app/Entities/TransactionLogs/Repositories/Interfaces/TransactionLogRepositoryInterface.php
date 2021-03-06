<?php

namespace App\Entities\Users\Repositories\Interfaces;

use App\Entities\Users\Entities\TransactionLogs\TransactionLog;

/**
 * Interface UserRepositoryInterface
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
