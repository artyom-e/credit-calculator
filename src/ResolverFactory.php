<?php

namespace ArtyomE\CreditCalculator;

use ArtyomE\CreditCalculator\Enums\CalculationType;
use ArtyomE\CreditCalculator\Exceptions\CalculationTypeIsNotImplementedException;
use ArtyomE\CreditCalculator\Resolvers\AbstractResolver;
use ArtyomE\CreditCalculator\Resolvers\AnnuityResolver;
use ArtyomE\CreditCalculator\Resolvers\DifferentiatedResolver;

class ResolverFactory
{
    public static function createResolver(CalculationType $calculationType): AbstractResolver
    {
        return match ($calculationType) {
            CalculationType::differentiated => new DifferentiatedResolver(),
            CalculationType::annuity => new AnnuityResolver(),
            default => throw new CalculationTypeIsNotImplementedException(),
        };
    }
}
