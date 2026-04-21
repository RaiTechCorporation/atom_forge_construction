<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreExpenseRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'project_id' => 'required|exists:projects,id',
            'date' => 'required|date',
            'category' => 'required|in:material,labour,equipment,transport,vendor_bill,misc',
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'vendor_id' => 'nullable|exists:vendors,id',
            'payment_mode' => 'required|in:cash,upi,bank',
            'bill' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ];
    }
}
