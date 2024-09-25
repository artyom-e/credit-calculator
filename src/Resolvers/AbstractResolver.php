<?php

namespace ArtyomE\CreditCalculator\Resolvers;

use ArtyomE\CreditCalculator\DTO\PaymentScheduleDto;

abstract class AbstractResolver
{
    public function __construct(protected int $term, protected float $amount, protected float $yearlyPercentage)
    {}

    abstract public function resolve(): PaymentScheduleDto;
}