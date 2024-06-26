<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AssetStoreRequest extends FormRequest
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
            'user_id'=>[
                'nullable',
            ],
            'asset_categorie'=>[
                'required',
                'string',
            ],
            'asset_type'=>[
                'required',
                'string',
            ],
            'avaiable_at'=>[
                'nullable',
                'date',
            ],
            'serial_number'=>[
                'nullable',
                'string',
                'max:40',
            ],
            'tag'=>[
                'nullable',
                'string',
            ],
            'patrimonial_id'=>[
                'nullable',
                'string',
                'max:40',
            ],
            'observation'=>[
                'nullable',
                'string',
            ],
        ];
    }
}
