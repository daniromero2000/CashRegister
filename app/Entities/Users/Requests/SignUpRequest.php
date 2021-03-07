<?php

namespace App\Entities\Users\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class SignUpRequest
 * @package App\Entities\Users\Requests
 */
class SignUpRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return string[][]
     */
    public function rules(): array
    {
        return [
            'name'     => 'required|string',
            'email'    => 'required|string|email|unique:users',
            'password' => 'required|string'
        ];
    }
}
