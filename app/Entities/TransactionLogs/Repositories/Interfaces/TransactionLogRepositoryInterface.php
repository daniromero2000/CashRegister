<?php

namespace App\Entities\TransactionLogs\Repositories\Interfaces;

use App\Entities\TransactionLogs\TransactionLog;
use Illuminate\Support\Collection;

/**
 * Interface UserRepositoryInterface
 * @package App\Entities\TransactionLogs\Repositories\Interfaces
 */
interface TransactionLogRepositoryInterface
{
    /**
     * @param array|string[] $columns
     * @return Collection
     */
    public function listTransactionLogs(array $columns = ['*']): Collection;

    /**
     * @param array $data
     * @return TransactionLog
     */
    public function createTransactionLog(array $data): TransactionLog;

    public function getTransactionLogsByDate(string $date, array $columns = ['*']): array;


}
