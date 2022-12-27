<?php

namespace App\Http\Controllers\V1\API\Account\Advertising;

use App\Http\Controllers\Controller;
use App\Http\Resources\Account\Advertising\PortfolioResource;
use App\Models\Account\Account;
use App\Models\Account\Advertising\Portfolio;
use App\Models\Account\Advertising\Profile;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $portfolios = QueryBuilder::for(Portfolio::where('profile_id', $request->marketplace->profile_id))
            ->allowedFilters(['state'])
            ->paginate();

        return PortfolioResource::collection($portfolios);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $portfolioId)
    {
        $portfolio = Portfolio::where('id', $portfolioId)
            ->where('profile_id',  $request->marketplace->profile_id)
            ->firstOrFail();

        return PortfolioResource::make($portfolio);
    }
}
