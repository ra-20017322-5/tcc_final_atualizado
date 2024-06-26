<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'=>[
                'required',
                'string',
                'min:5',
                'max:255',
            ],
            'email'=>[
                'required',
                'string',
                'min:5',
                'max:255',
                Rule::unique('users', 'email')->ignore($this->user, 'id')
            ],
            'user_type'=>[
                'required',
                'string',
                'min:1',
            ],
            'password'=>[
                'required',
                'string',
                'min:6',
                'max:20'
            ],
            'cellphone'=>[
                'required',
                'string',
                'min:14',
                'max:20',
            ],
            'telephone'=>[
                'nullable',
                'string',
                'min:14',
                'max:20',
            ],
            'personal_id_primary'=>[
                'required',
                'string',
                'min:10',
                'max:20',
            ],
            'personal_id_secundary'=>[
                'nullable',
                'string',
                'min:6',
                'max:20',
            ],
            'driver_id'=>[
                'nullable',
                'string',
                'min:8',
                'max:20',
            ]
        ];
    }
}
