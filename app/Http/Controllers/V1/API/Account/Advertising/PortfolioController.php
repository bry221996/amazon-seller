<?php

namespace App\Http\Controllers\V1\API\Account\Advertising;

use App\Http\Controllers\Controller;
use App\Http\Resources\Account\Advertising\PortfolioResource;
use App\Models\Account\Account;
use App\Models\Account\Advertising\Profile;
use App\V1\Services\Account\Advertising\PortfolioService;
use App\V1\Services\Account\Advertising\ProfileService;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Account $account, Profile $profile, PortfolioService $service)
    {
        $portfolios = $service->listByProfileId($profile->id, $request->all());

        return PortfolioResource::collection($portfolios);
    }
}
