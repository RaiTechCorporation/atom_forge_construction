<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $fillable = [
        'name',
        'unit',
        'min_stock',
    ];

    public function transactions()
    {
        return $this->hasMany(MaterialTransaction::class);
    }
}
