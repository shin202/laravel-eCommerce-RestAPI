<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class ProductRatingEnum extends Enum
{
    public const ZeroStar = 0;
    public const OneStar = 1;
    public const TwoStar = 2;
    public const ThreeStar = 3;
    public const FourStar = 4;
    public const FiveStar = 5;
}
