<?php

namespace App\Http\Controllers\V1\API\Account;

use App\Http\Controllers\Controller;
use App\Http\Resources\AccountResource;
use App\Models\Account\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function show(Request $request)
    {
        $request->account->load('marketplaces');

        return AccountResource::make($request->account);
    }
}
