<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investor extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'phone',
        'email',
        'address',
        'balance',
        'status',
    ];

    public function fundRequests()
    {
        return $this->hasMany(FundRequest::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function investments()
    {
        return $this->hasMany(Investment::class);
    }

    public function payouts()
    {
        return $this->hasMany(Payout::class);
    }

    public function bankAccounts()
    {
        return $this->hasMany(BankAccount::class);
    }

    public function primaryBankAccount()
    {
        return $this->hasOne(BankAccount::class)->where('is_primary', true);
    }
}
