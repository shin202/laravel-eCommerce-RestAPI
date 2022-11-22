<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class ProductTypeEnum extends Enum
{
    public const Man = 0;
    public const Women = 1;
    public const Child = 2;
}
