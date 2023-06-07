<?php

namespace App\Repositories\Interfaces\TransactionLogs;

use App\Models\TransactionLog;
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
    public function list(array $columns = ['*']): Collection;

    /**
     * @param array $data
     * @return TransactionLog
     */
    public function create(array $data): TransactionLog;

    /**
     * @param string $date
     * @param array|string[] $columns
     * @return array
     */
    public function getByDate(string $date, array $columns = ['*']): array;
}
