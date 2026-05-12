<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabourWorkProgress extends Model
{
    use HasFactory;

    protected $table = 'labour_work_progress';

    protected $fillable = [
        'site_manager_id',
        'project_id',
        'date',
        'shift',
        'file_path',
        'file_type',
        'latitude',
        'longitude',
    ];

    public function siteManager()
    {
        return $this->belongsTo(SiteManager::class, 'site_manager_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
