<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInvoiceRequest extends FormRequest
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
            'company_id' => 'required|exists:companies,id',
            'user_id' => 'required|exists:users,id',
            'date_issued' => 'required|date',
            'due_date' => 'required|date',
            'description.*' => 'required',
            'price.*' => 'required',
            'qty.*' => 'required',
            'tax' => 'required'
        ];
    }
}
