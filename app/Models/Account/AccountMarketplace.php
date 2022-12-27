<?php

namespace App\Models\Account;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class AccountMarketplace extends Pivot
{
    use HasFactory;

    protected $table = 'account_marketplaces';

    public $timestamps = false;
}
