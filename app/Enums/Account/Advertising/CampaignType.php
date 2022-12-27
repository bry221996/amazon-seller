<?php

declare(strict_types=1);

namespace App\Enums\Account\Advertising;

use BenSampo\Enum\Enum;

final class CampaignType extends Enum
{
    const SPONSORED_PRODUCTS = 'sponsoredProducts';
    const SPONSORED_DISPLAY = 'sponsoredDisplay';
    const SPONSORED_BRANDS = 'sponsoredBrands';
}
