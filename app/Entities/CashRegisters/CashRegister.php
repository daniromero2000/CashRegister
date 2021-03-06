<?php

namespace App\Entities\CashRegisters;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CashRegister
 * @package App\Entities\CashRegisters
 * @author Daniel Romero - 123romerod@gmail.com
 */
class CashRegister extends Model
{
    /**
     * @var string
     */
    protected $table = 'cash_register';

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'denomination',
        'value',
        'count',
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
