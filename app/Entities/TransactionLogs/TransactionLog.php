<?php

namespace App\Entities\TransactionLogs;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TransactionLog
 * @package App\Entities\TransactionLogs
 * @author Daniel Romero - 123romerod@gmail.com
 */
class TransactionLog extends Model
{
    /**
     * @var string
     */
    protected $table = 'transaction_logs';

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'type',
        'value',
        'created_at',
        'updated_at',
    ];

    /**
     * @var string[]
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    /**
     * @var string[]
     */
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    /**
     * @var string[]
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

}
