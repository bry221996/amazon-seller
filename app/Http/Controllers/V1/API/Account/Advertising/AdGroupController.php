<?php

namespace App\Http\Controllers\V1\API\Account\Advertising;

use App\Http\Controllers\Controller;
use App\Http\Resources\Account\Advertising\AdGroupResource;
use App\Models\Account\Advertising\AdGroup;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class AdGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $adGroups = QueryBuilder::for(AdGroup::where('profile_id', $request->marketplace->profile_id))
            ->allowedIncludes(['campaign'])
            ->allowedFilters([
                AllowedFilter::scope('states'),
                AllowedFilter::scope('campaign_ids'),
            ])
            ->paginate();

        return AdGroupResource::collection($adGroups);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Account\Advertising\AdGroup  $adGroup
     * @return \Illuminate\Http\Response
     */
    public function show(AdGroup $adGroup)
    {
        //
    }
}
