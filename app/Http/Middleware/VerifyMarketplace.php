<?php

namespace App\Http\Middleware;

use App\Models\Account\Marketplace;
use Closure;
use Illuminate\Http\Request;

class VerifyMarketplace
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $requiresProfile = false)
    {
        $marketplace_id = $request->header('X-Marketplace-ID');

        if (!$marketplace_id || !$request->marketplace = $request->account->marketplaces()->where('id', $marketplace_id)->first()) {
            return response(['status' => false, 'message' => 'Forbidden'], 403);
        }

        return $next($request);
    }
}
