<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectPaymentPhase extends Model
{
    protected $fillable = [
        'project_id',
        'phase_name',
        'amount',
        'due_date',
        'status',
    ];

    protected $casts = [
        'due_date' => 'date',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
