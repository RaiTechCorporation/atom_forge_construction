<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Labour extends Model
{
    protected $table = 'labour'; // specify since Laravel might pluralize to 'labours'

    protected static function booted()
    {
        static::creating(function ($labour) {
            if (empty($labour->labour_unique_id)) {
                $lastLabour = static::orderBy('id', 'desc')->first();
                $lastNumber = $lastLabour ? intval(substr($lastLabour->labour_unique_id, 4)) : 0;
                $labour->labour_unique_id = 'AFC-'.str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
            }
        });
    }

    protected $fillable = [
        'name',
        'labour_unique_id',
        'father_name',
        'phone',
        'current_address',
        'permanent_address',
        'city',
        'state',
        'pincode',
        'work_type',
        'shift_type',
        'start_time',
        'end_time',
        'break_time',
        'skill_level',
        'project_id',
        'wage_rate',
        'wage_type',
        'overtime_rate',
        'aadhaar_number',
        'pan_number',
        'id_proof_path',
        'pan_proof_path',
        'photo_path',
        'emergency_contact_name',
        'emergency_contact_number',
        'joining_date',
        'status',
        'remarks',
    ];

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function workProgress()
    {
        return $this->hasMany(LabourWorkProgress::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function getTotalEarnedAttribute()
    {
        return $this->total_regular_earned + $this->total_overtime_earned;
    }

    public function getTotalRegularEarnedAttribute()
    {
        // Count regular shifts (1st/2nd) marked as present
        $regularShiftsCount = $this->attendances()
            ->where('status', 'present')
            ->whereIn('shift', ['1st Shift', '2nd Shift'])
            ->count();

        return ($regularShiftsCount * 0.5) * ($this->wage_rate ?? 0);
    }

    public function getTotalOvertimeEarnedAttribute()
    {
        // Sum all overtime hours from present shifts
        $overtimeHours = $this->attendances()
            ->where('status', 'present')
            ->sum('overtime_hours');

        return $overtimeHours * (($this->wage_rate ?? 0) / 8);
    }

    public function getTotalPaidAttribute()
    {
        return $this->attendances()->sum('payment_amount');
    }

    public function getBalanceDueAttribute()
    {
        return $this->total_earned - $this->total_paid;
    }
}
