<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'string',
            'last_name' => 'string',
            'patronymic' => 'string',
            'gender' => 'in:unknown,female,male',
            'salary' => 'integer',
            'departments' => 'array|min:1',
            'departments.*' => 'integer'
        ];
    }
}
