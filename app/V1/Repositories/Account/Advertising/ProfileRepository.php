<?php

namespace App\V1\Repositories\Account\Advertising;

use App\Models\Account\Advertising\Profile;
use App\V1\Repositories\BaseRepository;

class ProfileRepository
{
    public function getAllByAccountId(string $account_id, array  $options = [])
    {
        return Profile::where('account_id', $account_id)
            ->with(isset($options['include']) ? $options['include'] : [])
            ->get();
    }

    public function upsert($data, $uniqColumns = [], $updateColumns = [])
    {
        return Profile::upsert($data, $uniqColumns, $updateColumns);
    }
}
