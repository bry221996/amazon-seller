<?php

namespace App\Http\Controllers\V1\API\Account\Advertising;

use App\Http\Controllers\Controller;
use App\Http\Resources\Account\Advertising\CampaignResource;
use App\Models\Account\Advertising\Campaign;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class CampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $campaigns = QueryBuilder::for(Campaign::where('profile_id', $request->marketplace->profile_id))
            ->allowedFilters([
                AllowedFilter::scope('portfolio_ids'),
                AllowedFilter::scope('campaign_types'),
                AllowedFilter::scope('targeting_types'),
            ])
            ->paginate();

        return CampaignResource::collection($campaigns);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
}
