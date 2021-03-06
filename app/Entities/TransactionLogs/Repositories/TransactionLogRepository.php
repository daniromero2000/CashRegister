<?php

namespace App\Entities\Users\Entities\TransactionLogs\Repositories;

use App\Entities\Users\Entities\TransactionLogs\TransactionLog;

/**
 * Class UserRepository
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
        $this->transactionLog = $transactionLog;
    }

    /**
     * @param array|string[] $columns
     * @return array
     */
    public function listLogs(array $columns = ['*']): array
    {
        return $this->transactionLog->get($columns)->toArray();
    }

    /**
     * @param array $data
     * @return TransactionLog
     */
    public function createLog(array $data): TransactionLog
    {
        return $this->transactionLog->create($data);
    }
}
