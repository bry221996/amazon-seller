<?php

namespace App\Models\Account;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marketplace extends Model
{
    use HasFactory;

    public $incrementing = false;

    public function account()
    {
        return $this->belongsToMany(Account::class, 'account_marketplaces')
            ->withPivot(['profile_id']);
    }
}
