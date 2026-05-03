<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreSiteManagerRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:site_managers,email|unique:users,email',
            'password' => 'required|string|min:8',
            'phone' => 'nullable|string|max:20',
            'father_name' => 'nullable|string|max:255',
            'current_address' => 'nullable|string',
            'permanent_address' => 'nullable|string',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'pincode' => 'nullable|string|max:20',
            'qualification' => 'nullable|string|max:255',
            'tenth_passing_year' => 'nullable|string|max:10',
            'tenth_percentage' => 'nullable|string|max:10',
            'tenth_board' => 'nullable|string|max:255',
            'twelfth_passing_year' => 'nullable|string|max:10',
            'twelfth_percentage' => 'nullable|string|max:10',
            'twelfth_board' => 'nullable|string|max:255',
            'graduation_passing_year' => 'nullable|string|max:10',
            'graduation_percentage' => 'nullable|string|max:10',
            'graduation_university' => 'nullable|string|max:255',
            'experience' => 'nullable|string|max:255',
            'project_id' => 'nullable|exists:projects,id',
            'salary_amount' => 'required|numeric|min:0',
            'salary_type' => 'required|string|in:Monthly,Daily,Weekly',
            'aadhaar_number' => 'nullable|string|max:20',
            'pan_number' => 'nullable|string|max:20',
            'id_proof_path' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'pan_proof_path' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'photo_path' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'certificate_10th_path' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'certificate_12th_path' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'graduation_certificate_path' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'skilled_certificate_path' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'emergency_contact_name' => 'nullable|string|max:255',
            'emergency_contact_number' => 'nullable|string|max:20',
            'joining_date' => 'nullable|date',
            'status' => 'required|string|in:Active,Inactive,On Leave',
            'remarks' => 'nullable|string',
            'experiences' => 'nullable|array',
            'experiences.*.job_title' => 'required|string|max:255',
            'experiences.*.company_name' => 'required|string|max:255',
            'experiences.*.location' => 'nullable|string|max:255',
            'experiences.*.start_date' => 'required|date',
            'experiences.*.end_date' => 'nullable|date|after_or_equal:experiences.*.start_date',
            'experiences.*.responsibilities_achievements' => 'nullable|string',
        ];
    }
}
