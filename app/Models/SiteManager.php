<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteManager extends Model
{
    protected $table = 'site_managers';

    protected $fillable = [
        'manager_unique_id',
        'user_id',
        'name',
        'email',
        'phone',
        'father_name',
        'current_address',
        'permanent_address',
        'city',
        'state',
        'pincode',
        'qualification',
        'tenth_passing_year',
        'tenth_percentage',
        'tenth_board',
        'twelfth_passing_year',
        'twelfth_percentage',
        'twelfth_board',
        'graduation_passing_year',
        'graduation_percentage',
        'graduation_university',
        'experience',
        'project_id',
        'salary_amount',
        'salary_type',
        'aadhaar_number',
        'pan_number',
        'id_proof_path',
        'pan_proof_path',
        'photo_path',
        'certificate_10th_path',
        'certificate_12th_path',
        'graduation_certificate_path',
        'skilled_certificate_path',
        'emergency_contact_name',
        'emergency_contact_number',
        'joining_date',
        'leave_balance',
        'status',
        'remarks',
    ];

    protected static function booted()
    {
        static::creating(function ($manager) {
            if (empty($manager->manager_unique_id)) {
                $lastManager = static::orderBy('id', 'desc')->first();
                $lastNumber = $lastManager ? intval(substr($lastManager->manager_unique_id, 3)) : 0;
                $manager->manager_unique_id = 'SM-'.str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function attendances()
    {
        return $this->hasMany(SiteManagerAttendance::class);
    }

    public function payouts()
    {
        return $this->hasMany(SiteManagerPayout::class);
    }

    public function experiences()
    {
        return $this->hasMany(SiteManagerExperience::class);
    }

    public function getAttendanceSummary($month, $year)
    {
        $attendances = $this->attendances()
            ->whereYear('date', $year)
            ->whereMonth('date', $month)
            ->get();

        $totalPresent = $attendances->where('status', 'Present')->count();
        $totalAbsent = $attendances->where('status', 'Absent')->count();
        $totalHalfDay = $attendances->where('status', 'Half Day')->count();
        $totalWorkingDays = $attendances->count();

        $attendancePercentage = $totalWorkingDays > 0 
            ? (($totalPresent + ($totalHalfDay * 0.5)) / $totalWorkingDays) * 100 
            : 0;

        return [
            'total_working_days' => $totalWorkingDays,
            'total_present' => $totalPresent,
            'total_absent' => $totalAbsent,
            'total_half_day' => $totalHalfDay,
            'attendance_percentage' => round($attendancePercentage, 2),
        ];
    }
}
