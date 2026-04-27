<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectPayment extends Model
{
    protected $fillable = [
        'project_id',
        'amount_paid',
        'payment_date',
        'payment_mode',
        'reference_no',
        'note',
        'proof_image',
    ];

    protected $casts = [
        'payment_date' => 'date',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
