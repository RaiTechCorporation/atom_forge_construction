<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreLabourRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'father_name' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'current_address' => 'nullable|string',
            'permanent_address' => 'nullable|string',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'pincode' => 'nullable|string|max:20',
            'work_type' => 'required|string|max:255',
            'shift_type' => 'nullable|string|in:Full Day,Half Day,Hourly',
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i',
            'break_time' => 'nullable|string|max:255',
            'skill_level' => 'nullable|string|in:Skilled,Semi-Skilled,Unskilled',
            'project_id' => 'nullable|exists:projects,id',
            'wage_rate' => 'required|numeric|min:0',
            'wage_type' => 'nullable|string|in:Daily,Hourly,Monthly',
            'overtime_rate' => 'nullable|numeric|min:0',
            'aadhaar_number' => 'nullable|string|max:20',
            'pan_number' => 'nullable|string|max:20',
            'id_proof_path' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'pan_proof_path' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'photo_path' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'emergency_contact_name' => 'nullable|string|max:255',
            'emergency_contact_number' => 'nullable|string|max:20',
            'joining_date' => 'nullable|date',
            'status' => 'nullable|string|in:Active,Inactive',
            'remarks' => 'nullable|string',
        ];
    }
}
