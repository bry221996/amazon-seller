<?php

namespace App\Models\Account\Advertising;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    public $incrementing = false;

    public $timestamps = false;

    public function portfolio()
    {
        return $this->belongsTo(Portfolio::class);
    }

    public function scopeCampaignTypes($query, ...$value)
    {
        return $query->whereIn('campaign_type', $value);
    }

    public function scopeTargetingTypes($query, ...$value)
    {
        return $query->whereIn('targeting_type', $value);
    }

    public function scopePortfolioIds($query, ...$value)
    {
        return $query->whereIn('portfolio_id', $value);
    }

    public function scopeStates($query, ...$value)
    {
        return $query->whereIn('state', $value);
    }
}
