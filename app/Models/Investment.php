<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investment extends Model
{
    use HasFactory;

    protected $fillable = [
        'investor_id',
        'project_id',
        'created_by',
        'investment_amount',
        'investment_date',
        'expected_return',
        'profit_share',
        'payout_cycle',
        'agreement_file',
        'status',
        'notes',
    ];

    protected $casts = [
        'investment_date' => 'date',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function investor()
    {
        return $this->belongsTo(Investor::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function generateWhatsAppLink()
    {
        $message = urlencode("Investment Confirmation\nProject: {$this->project->name}\nAmount: ₹".number_format($this->investment_amount)."\nDate: {$this->investment_date}\nStatus: ".ucfirst($this->status));

        return "https://wa.me/{$this->investor->phone}?text={$message}";
    }
}
