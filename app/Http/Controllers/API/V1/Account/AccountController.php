<?php

namespace App\Http\Controllers\API\V1\Account;

use App\Http\Controllers\Controller;
use App\Http\Resources\AccountResource;
use App\Models\Account\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function show(Account $account)
    {
        return AccountResource::make($account);
    }
}
