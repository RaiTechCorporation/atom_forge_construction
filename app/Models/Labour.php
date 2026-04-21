<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Labour extends Model
{
    protected $table = 'labour'; // specify since Laravel might pluralize to 'labours'

    protected $fillable = [
        'name',
        'phone',
        'work_type',
        'wage_rate',
    ];

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}
