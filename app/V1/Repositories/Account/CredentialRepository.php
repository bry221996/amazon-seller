<?php

namespace App\V1\Repositories\Account;

use App\Models\Account\Credential;

class CredentialRepository
{
    public function getByAccountIdAndService(string $account_id, string $service)
    {
        return Credential::where('account_id', $account_id)
            ->where('service', $service)
            ->first();
    }
}
