<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabourWorkProgress extends Model
{
    use HasFactory;

    protected $table = 'labour_work_progress';

    protected $fillable = [
        'labour_id',
        'project_id',
        'date',
        'shift',
        'file_path',
        'file_type',
    ];

    public function labour()
    {
        return $this->belongsTo(Labour::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
