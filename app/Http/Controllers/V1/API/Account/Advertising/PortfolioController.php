<?php

namespace App\Http\Controllers\V1\API\Account\Advertising;

use App\Http\Controllers\Controller;
use App\Http\Resources\Account\Advertising\PortfolioResource;
use App\Models\Account\Account;
use App\Models\Account\Advertising\Portfolio;
use App\Models\Account\Advertising\Profile;
use Spatie\QueryBuilder\QueryBuilder;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Account $account, Profile $profile)
    {
        $portfolios = QueryBuilder::for(Portfolio::where('profile_id', $profile->id))
            ->allowedFilters(['state'])
            ->paginate();

        return PortfolioResource::collection($portfolios);
    }
}
