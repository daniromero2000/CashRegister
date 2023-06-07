<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Payment
 * @package App\Entities\Payments
 * @author Daniel Romero - 123romerod@gmail.com
 */
class Payment extends Model
{
    /**
     * @var string
     */
    protected $table = 'payments';

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'customer_payment',
        'amount_payable',
        'total_returned',
        'payment_denomination',
        'created_at',
        'updated_at'
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
    protected $dates = [
        'created_at',
        'updated_at',
    ];
}
