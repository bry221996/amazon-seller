<?php

namespace App\Models\Account\Advertising;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;

    public $incrementing = false;

    public $timestamps = false;

    protected $casts = [
        'in_budget' => 'boolean'
    ];

    public function getBudgetAttribute($value)
    {
        return json_decode($value);
    }
}
