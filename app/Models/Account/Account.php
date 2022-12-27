<?php

namespace App\Models\Account;

use App\Models\Account\Advertising\Profile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    public $incrementing = false;

    public function marketplaces()
    {
        return $this->belongsToMany(Marketplace::class, 'account_marketplaces');
    }

    public function advertisingProfiles()
    {
        return $this->hasMany(Profile::class);
    }
}
