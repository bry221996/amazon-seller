<?php

namespace App\Models\Account;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    public $incrementing = false;

    public function marketplaces()
    {
        return $this->belongsToMany('account_marketplaces');
    }
}
