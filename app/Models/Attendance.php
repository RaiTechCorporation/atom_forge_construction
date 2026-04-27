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
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function labour()
    {
        return $this->belongsTo(Labour::class);
    }
}
