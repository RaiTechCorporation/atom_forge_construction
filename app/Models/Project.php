<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'client_id',
        'client_name',
        'location',
        'project_type',
        'cost_per_sqft',
        'total_area_sqft',
        'start_date',
        'end_date',
        'total_budget',
        'status',
        'stage',
        'description',
        'features',
    ];

    protected $casts = [
        'features' => 'array',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function materialTransactions()
    {
        return $this->hasMany(MaterialTransaction::class);
    }

    public function investments()
    {
        return $this->hasMany(Investment::class);
    }

    public function projectUpdates()
    {
        return $this->hasMany(ProjectUpdate::class);
    }

    public function payouts()
    {
        return $this->hasMany(Payout::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}
