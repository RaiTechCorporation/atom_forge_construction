<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
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
            'project_code' => 'nullable|string|max:50|unique:projects,project_code',
            'name' => 'required|string|max:255',
            'client_name' => 'required|string|max:255',
            'client_phone' => 'nullable|string|max:20',
            'client_email' => 'nullable|email|max:255',
            'contractor_name' => 'nullable|string|max:255',
            'project_manager' => 'nullable|string|max:255',
            'architect' => 'nullable|string|max:255',
            'consultant' => 'nullable|string|max:255',
            'vendor_list' => 'nullable|string',
            'location' => 'required|string|max:255',
            'site_address' => 'required|string',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'zip_code' => 'required|string|max:20',
            'gps_coordinates' => 'nullable|string|max:255',
            'project_type' => 'required|string|in:Basic,Standard,Premium,Luxury,Ultra Luxury,Custom',
            'building_type' => 'required|string|in:Residential,Commercial,Industrial,Infrastructure',
            'total_area_sqft' => 'nullable|numeric|min:0',
            'number_of_floors' => 'nullable|integer|min:0',
            'units_count' => 'nullable|integer|min:0',
            'construction_type' => 'nullable|string|in:RCC,Steel,Prefab,Other',
            'material_specifications' => 'nullable|string',
            'design_documents.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png,dwg,zip|max:10240',
            'contracts_agreements.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx,zip|max:10240',
            'permits_licenses.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png,zip|max:10240',
            'safety_documents.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png,zip|max:10240',
            'blueprints_layouts.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png,dwg,zip|max:10240',
            'site_media.*' => 'nullable|file|mimes:jpg,jpeg,png,mp4,mov,avi|max:20480',
            'progress_photos.*' => 'nullable|file|mimes:jpg,jpeg,png|max:10240',
            'inspection_reports.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png,zip|max:10240',
            'deadline_alerts' => 'nullable|boolean',
            'budget_alerts' => 'nullable|boolean',
            'task_reminders' => 'nullable|boolean',
            'need_funding' => 'nullable|boolean',
            'identified_risks' => 'nullable|string',
            'issue_logs' => 'nullable|string',
            'delay_reasons' => 'nullable|string',
            'mitigation_plans' => 'nullable|string',
            'assigned_team' => 'nullable|string',
            'labor_requirements' => 'nullable|string',
            'equipment_machinery' => 'nullable|string',
            'subcontractors' => 'nullable|string',
            'wbs_tasks' => 'nullable|string',
            'task_assignments' => 'nullable|string',
            'progress_percent' => 'nullable|integer|min:0|max:100',
            'reports_summary' => 'nullable|string',
            'issue_tracking' => 'nullable|string',
            'material_requirements' => 'nullable|string',
            'suppliers_info' => 'nullable|string',
            'purchase_orders_summary' => 'nullable|string',
            'inventory_tracking' => 'nullable|string',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'estimated_duration' => 'nullable|string|max:255',
            'milestone_planning_approval' => 'nullable|date',
            'milestone_foundation_start' => 'nullable|date',
            'milestone_structure_completion' => 'nullable|date',
            'milestone_finishing_phase' => 'nullable|date',
            'milestone_handover' => 'nullable|date',
            'total_budget' => 'required|numeric|min:0',
            'est_cost_materials' => 'nullable|numeric|min:0',
            'est_cost_labor' => 'nullable|numeric|min:0',
            'est_cost_equipment' => 'nullable|numeric|min:0',
            'est_cost_miscellaneous' => 'nullable|numeric|min:0',
            'payment_terms' => 'nullable|string',
            'advance_payment' => 'nullable|numeric|min:0',
            'billing_cycle' => 'nullable|in:Milestone-based,Monthly',
            'status' => 'required|in:Planned,Ongoing,Completed,On Hold',
            'priority' => 'required|in:Low,Medium,High,Urgent',
        ];
    }
}
