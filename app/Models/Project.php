<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_code',
        'name',
        'client_id',
        'client_name',
        'client_phone',
        'client_email',
        'contractor_name',
        'project_manager',
        'architect',
        'consultant',
        'vendor_list',
        'location',
        'site_address',
        'city',
        'state',
        'country',
        'zip_code',
        'gps_coordinates',
        'project_type',
        'building_type',
        'cost_per_sqft',
        'total_area_sqft',
        'number_of_floors',
        'units_count',
        'construction_type',
        'material_specifications',
        'design_documents',
        'assigned_team',
        'labor_requirements',
        'equipment_machinery',
        'subcontractors',
        'wbs_tasks',
        'task_assignments',
        'progress_percent',
        'reports_summary',
        'issue_tracking',
        'material_requirements',
        'suppliers_info',
        'purchase_orders_summary',
        'inventory_tracking',
        'contracts_agreements',
        'permits_licenses',
        'safety_documents',
        'blueprints_layouts',
        'identified_risks',
        'issue_logs',
        'delay_reasons',
        'mitigation_plans',
        'site_media',
        'progress_photos',
        'inspection_reports',
        'deadline_alerts',
        'budget_alerts',
        'task_reminders',
        'start_date',
        'end_date',
        'estimated_duration',
        'milestone_planning_approval',
        'milestone_foundation_start',
        'milestone_structure_completion',
        'milestone_finishing_phase',
        'milestone_handover',
        'total_budget',
        'est_cost_materials',
        'est_cost_labor',
        'est_cost_equipment',
        'est_cost_miscellaneous',
        'payment_terms',
        'advance_payment',
        'billing_cycle',
        'status',
        'need_funding',
        'priority',
        'stage',
        'description',
        'features',
    ];

    protected $casts = [
        'features' => 'array',
        'design_documents' => 'array',
        'contracts_agreements' => 'array',
        'permits_licenses' => 'array',
        'safety_documents' => 'array',
        'blueprints_layouts' => 'array',
        'site_media' => 'array',
        'progress_photos' => 'array',
        'inspection_reports' => 'array',
        'deadline_alerts' => 'boolean',
        'budget_alerts' => 'boolean',
        'task_reminders' => 'boolean',
        'need_funding' => 'boolean',
        'start_date' => 'date',
        'end_date' => 'date',
        'milestone_planning_approval' => 'date',
        'milestone_foundation_start' => 'date',
        'milestone_structure_completion' => 'date',
        'milestone_finishing_phase' => 'date',
        'milestone_handover' => 'date',
    ];

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function materialTransactions()
    {
        return $this->hasMany(MaterialTransaction::class);
    }

    public function investments()
    {
        return $this->hasMany(Investment::class);
    }

    public function projectUpdates()
    {
        return $this->hasMany(ProjectUpdate::class);
    }

    public function payouts()
    {
        return $this->hasMany(Payout::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}
