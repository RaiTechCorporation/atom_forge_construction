<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMaterialTransactionRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'project_id' => 'required|exists:projects,id',
            'material_id' => 'required|exists:materials,id',
            'type' => 'required|in:purchase,transfer_in,transfer_out,consumption',
            'quantity' => 'required|numeric|min:0',
            'date' => 'required|date',
            'rate' => 'nullable|numeric|min:0',
            'vendor_id' => 'nullable|exists:vendors,id',
            'bill' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ];
    }
}
