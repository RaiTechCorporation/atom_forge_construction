<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $table = 'attendance';

    protected $fillable = [
        'project_id',
        'labour_id',
        'date',
        'status',
        'shift',
        'overtime_hours',
        'payment_amount',
        'remark',
        'notes',
        'recorded_by',
        'recorded_at',
    ];

    protected $casts = [
        'recorded_at' => 'datetime',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function labour()
    {
        return $this->belongsTo(Labour::class);
    }

    public function recorder()
    {
        return $this->belongsTo(User::class, 'recorded_by');
    }
}
