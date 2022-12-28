<?php

namespace App\Models\Account\Advertising;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdGroup extends Model
{
    use HasFactory;

    public $incrementing = false;

    public $timestamps = false;

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function scopeStates($query, ...$value)
    {
        return $query->whereIn('state', $value);
    }
}
