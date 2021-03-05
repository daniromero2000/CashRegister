<?php


namespace App\Entities\CashFlows;


use Illuminate\Database\Eloquent\Model;

class CashFlow extends Model
{
    /**
     * @var string
     */
    protected $table = 'cash_flow';

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
