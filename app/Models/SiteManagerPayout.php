<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteManagerPayout extends Model
{
    protected $table = 'site_manager_payouts';

    protected $fillable = [
        'site_manager_id',
        'payout_date',
        'month',
        'base_salary',
        'bonus',
        'deductions',
        'absence_deduction',
        'late_arrival_deduction',
        'advance_salary_recovery',
        'penalty_deduction',
        'net_amount',
        'paid_amount',
        'payment_method',
        'transaction_id',
        'status',
        'remarks',
    ];

    public function siteManager()
    {
        return $this->belongsTo(SiteManager::class);
    }
}
