<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteManagerExperience extends Model
{
    protected $fillable = [
        'site_manager_id',
        'job_title',
        'company_name',
        'location',
        'start_date',
        'end_date',
        'responsibilities_achievements',
    ];

    public function siteManager()
    {
        return $this->belongsTo(SiteManager::class);
    }
}
