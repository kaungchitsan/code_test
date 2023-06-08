<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BillingRequest extends FormRequest
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
            'amount' => 'required',
            'due_date' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'amount.required' => 'Please fill amount.',
            'due_date.required' => 'Due date required for this form.',
        ];
    }
}
