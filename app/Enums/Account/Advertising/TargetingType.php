<?php

declare(strict_types=1);

namespace App\Enums\Account\Advertising;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class TargetingType extends Enum
{
    const AUTO = 'auto';
    const MANUAL = 'manual';
}
