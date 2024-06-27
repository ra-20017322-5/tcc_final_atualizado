<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id'=>[
                'required',
                'string',
            ],
            'upload_type'=>[
                'required',
                'string',
            ],
            'reference_id'=>[
                'required',
                'string',
            ],
            'uuid'=>[
                'required',
                'string',
            ],
            'file_size'=>[
                'required',
                'string',
            ],
            'file_name'=>[
                'required',
                'string',
            ],
            'file_name_upload'=>[
                'required',
                'string',
            ],
            'observation'=>[
                'nullable',
                'max:4000',
            ]
        ];
    }
}
