<?php

namespace App\Entities\TransactionLogs\Repositories;

use App\Entities\TransactionLogs\Exceptions\CreateTransactionLogErrorException;
use App\Entities\TransactionLogs\Repositories\Interfaces\TransactionLogRepositoryInterface;
use App\Entities\TransactionLogs\TransactionLog;
use Illuminate\Database\QueryException;

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
     * @return array
     */
    public function listTransactionLogs(array $columns = ['*']): array
    {
        return $this->transactionLog->get($columns)->toArray();
    }

    /**
     * @param array $data
     * @return TransactionLog
     * @throws CreateTransactionLogErrorException
     */
    public function createTransactionLog(array $data): TransactionLog
    {
        try{
            return $this->transactionLog->create($data);
        }catch (QueryException $e){
            throw new CreateTransactionLogErrorException($e);
        }
    }
}
