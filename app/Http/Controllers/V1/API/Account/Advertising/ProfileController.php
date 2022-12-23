<?php

namespace App\Http\Controllers\V1\API\Account\Advertising;

use App\Http\Controllers\Controller;
use App\Http\Resources\Account\Advertising\ProfileResource;
use App\Models\Account\Account;
use App\Models\Account\Advertising\Profile;
use App\V1\Services\Account\Advertising\ProfileService;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Account $account, ProfileService $service)
    {
        $profiles = $service->getAllByAccountId($account->id, $request->all());

        return ProfileResource::collection($profiles);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Account\Advertising\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        //
    }
}
