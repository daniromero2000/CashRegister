<?php

namespace App\Repositories\TransactionLogs;

use App\Models\TransactionLog;
use App\Repositories\Interfaces\TransactionLogs\TransactionLogRepositoryInterface;
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
    public function list(array $columns = ['*']): Collection
    {
        return $this->transactionLog->get($columns);
    }

    /**
     * @param array $data
     * @return TransactionLog
     */
    public function create(array $data): TransactionLog
    {
        return $this->transactionLog->create($data);
    }

    /**
     * @param string $date
     * @param array|string[] $columns
     * @return array
     */
    public function getByDate(string $date, array $columns = ['*']): array
    {
        return $this->transactionLog->where('created_at', '<=', $date)->get($columns)->toArray();
    }
}
