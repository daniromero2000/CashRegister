<?php

namespace App\Entities\TransactionLogs\Repositories;

use App\Entities\TransactionLogs\TransactionLog;

/**
 * Class TransactionLogRepository
 * @package App\Entities\TransactionLogs\Repositories
 * @author Daniel Romero - 123romerod@gmail.com
 */
class TransactionLogRepository
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
        $this->log = $transactionLog;
    }

    /**
     * @param array|string[] $columns
     * @return array
     */
    public function listLogs(array $columns = ['*']): array
    {
        return $this->log->with('cashFlow')->get($columns)->toArray();
    }

    /**
     * @param array $data
     * @return TransactionLog
     */
    public function createLog(array $data): TransactionLog
    {
        return $this->log->create($data);
    }
}
