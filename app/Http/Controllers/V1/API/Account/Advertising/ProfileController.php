<?php

namespace App\Http\Controllers\V1\API\Account\Advertising;

use App\Http\Controllers\Controller;
use App\Http\Resources\Account\Advertising\ProfileResource;
use App\Models\Account\Account;
use App\Models\Account\Advertising\Profile;
use Spatie\QueryBuilder\QueryBuilder;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Account $account)
    {
        $profiles = QueryBuilder::for(Profile::where('account_id', $account->id))
            ->allowedIncludes(['marketplace'])
            ->get();

        return ProfileResource::collection($profiles);
    }
}
