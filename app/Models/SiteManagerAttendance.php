<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteManagerAttendance extends Model
{
    protected $table = 'site_manager_attendance';

    protected $fillable = [
        'site_manager_id',
        'project_id',
        'date',
        'status',
        'leave_type',
        'overtime_hours',
        'remarks',
        'recorded_by',
        'recorded_at',
    ];

    protected $casts = [
        'recorded_at' => 'datetime',
    ];

    public function siteManager()
    {
        return $this->belongsTo(SiteManager::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function recorder()
    {
        return $this->belongsTo(User::class, 'recorded_by');
    }
}
