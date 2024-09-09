<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IncomesRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'incomes_name' => 'required|string',
            'amount' => 'required|numeric|min:0|regex:/^\d+(\.\d{1,2})?$/',
            'tax_amount' => 'nullable|numeric|min:0|regex:/^\d+(\.\d{1,2})?$/',
            'due_date' => 'nullable|date',
            'issue_date' => 'nullable|required|date',
            'date_received' => 'nullable|date',
            'obs' => 'string|nullable',
        ];
    }
}
