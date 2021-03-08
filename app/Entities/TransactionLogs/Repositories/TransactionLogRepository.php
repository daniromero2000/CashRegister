<?php

namespace App\Entities\TransactionLogs\Repositories;

use App\Entities\TransactionLogs\Exceptions\CreateTransactionLogErrorException;
use App\Entities\TransactionLogs\Repositories\Interfaces\TransactionLogRepositoryInterface;
use App\Entities\TransactionLogs\TransactionLog;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;

/**
 * Class UserRepository
 * @package App\Entities\TransactionLogs\Repositories
 * @author Daniel Romero - 123romerod@gmail.com
 */
class TransactionLogRepository implements TransactionLogRepositoryInterface
{
    /**
     * @var TransactionLog
     */
    protected $transactionLog;

    /**
     * LogRepository constructor.
     * @param TransactionLog $transactionLog
     */
    public function __construct(TransactionLog $transactionLog)
    {
        $this->transactionLog = $transactionLog;
    }

    /**
     * @param array|string[] $columns
     * @return Collection
     */
    public function listTransactionLogs(array $columns = ['*']): Collection
    {
        return $this->transactionLog->get($columns);
    }

    /**
     * @param array $data
     * @return TransactionLog
     * @throws CreateTransactionLogErrorException
     */
    public function createTransactionLog(array $data): TransactionLog
    {
        return $this->transactionLog->create($data);
    }

    public function getTransactionLogsByDate(string $date, array $columns = ['*']): array
    {
        return $this->transactionLog->where('created_at', '<=', $date)->get($columns)->toArray();
    }
}
