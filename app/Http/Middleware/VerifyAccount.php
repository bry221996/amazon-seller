<?php

namespace App\Http\Middleware;

use App\Models\Account\Account;
use Closure;
use Illuminate\Http\Request;

class VerifyAccount
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $account_id = $request->header('X-Account-ID');

        if (!$account_id || !$request->account = Account::find($account_id)) {
            return response(['status' => false, 'message' => 'Forbidden'], 403);
        }

        return $next($request);
    }
}
