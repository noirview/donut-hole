<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
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
            'name' => 'required|string',
            'last_name' => 'required|string',
            'patronymic' => 'required|string',
            'gender' => 'in:unknown,female,male',
            'salary' => 'required|integer',
            'departments' => 'array|min:1',
            'departments.*' => 'integer'
        ];
    }
}
