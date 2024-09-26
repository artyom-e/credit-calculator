<?php

use ArtyomE\CreditCalculator\Enums\CalculationType;
use ArtyomE\CreditCalculator\ResolverFactory;
use ArtyomE\CreditCalculator\Resolvers\AnnuityResolver;
use ArtyomE\CreditCalculator\Resolvers\DifferentiatedResolver;

it('can create annuity resolver', function () {
    $resolver = ResolverFactory::createResolver(CalculationType::annuity);
    expect($resolver)->toBeInstanceOf(AnnuityResolver::class);
});

it('can create differentiated resolver', function () {
    $resolver = ResolverFactory::createResolver(CalculationType::differentiated);
    expect($resolver)->toBeInstanceOf(DifferentiatedResolver::class);
});
