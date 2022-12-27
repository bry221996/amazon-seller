<?php

namespace App\Http\Controllers\V1\API\Account;

use App\Http\Controllers\Controller;
use App\Http\Resources\AccountResource;
use App\Http\Resources\MarketplaceResource;
use App\Models\Account\Account;
use Illuminate\Http\Request;

class AccountMarketplaceController extends Controller
{
    public function index(Request $request)
    {
        $request->account->load('marketplaces');

        return MarketplaceResource::collection($request->account->marketplaces);
    }
}
