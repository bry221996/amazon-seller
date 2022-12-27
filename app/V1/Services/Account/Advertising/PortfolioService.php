<?php

namespace App\V1\Services\Account\Advertising;

use App\Models\Account\Advertising\Portfolio;

class PortfolioService
{
    /**
     * List portfolios by profile id.
     *
     * @param string $profile_id
     * @param array $options
     * @return array Portfolio
     */
    public function listByProfileId(string $profile_id, array $options = [])
    {
        return Portfolio::where('profile_id', $profile_id)
            ->with(isset($options['include']) ? $options['include'] : [])
            ->paginate();
    }
}
