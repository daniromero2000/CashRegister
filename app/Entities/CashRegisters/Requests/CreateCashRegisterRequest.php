<?php

namespace App\Entities\CashRegisters\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CreateCashRegisterRequest
 * @package App\Entities\CashRegisters\Requests
 */
class CreateCashRegisterRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'denomination' => 'required|in:coin,bill',
            'value'        => 'in:100000,50000,20000,10000,5000,1000,500,200,100,50|required|integer',
            'quantity'     => 'required'
        ];
    }
}
