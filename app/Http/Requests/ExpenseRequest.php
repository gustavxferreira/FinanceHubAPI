<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExpenseRequest extends FormRequest
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
            'fixed_payment_id' => 'nullable|numeric|digits:1',
            'expense_name' => 'string|required|min:5|max:200',
            'fixed_payment' => 'nullable|numeric|digits:1',
            'due_date' => 'required|date',
            'date_payed' => 'nullable|date',
            'obs' => 'string|nullable',
            'repeat' => 'nullable|numeric|digits:1',
            'amount' => 'required|numeric|min:0|regex:/^\d+(\.\d{1,2})?$/',
            'category_id' => 'required|numeric',
            'times_installments' => 'nullable|numeric',
        ];
    }
}
