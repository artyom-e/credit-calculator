<?php

declare(strict_types=1);

namespace ArtyomE\CreditCalculator\Enums;

enum CalculationType
{
    case differentiated;

    case annuity;

    case bullet;
}
