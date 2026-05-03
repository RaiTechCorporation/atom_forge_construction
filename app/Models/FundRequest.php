<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FundRequest extends Model
{
    protected $fillable = [
        'investor_id',
        'amount',
        'payment_method',
        'reference_number',
        'receipt_proof',
        'status',
        'admin_notes',
        'processed_by',
        'processed_at',
    ];

    protected $casts = [
        'processed_at' => 'datetime',
    ];

    public function investor()
    {
        return $this->belongsTo(Investor::class);
    }

    public function processor()
    {
        return $this->belongsTo(User::class, 'processed_by');
    }
}
