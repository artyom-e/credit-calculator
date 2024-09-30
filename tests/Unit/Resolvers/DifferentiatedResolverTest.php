<?php

declare(strict_types=1);

use ArtyomE\CreditCalculator\DTO\PaymentScheduleDto;
use ArtyomE\CreditCalculator\DTO\PaymentScheduleItemDto;
use ArtyomE\CreditCalculator\Resolvers\DifferentiatedResolver;

it('can resolve differentiated payment schedule', function () {
    $resolver = new DifferentiatedResolver();
    $actualResult = $resolver->resolve(6, 5000, 45);
    $expectedResult = new PaymentScheduleDto(
        totalAmountWithInterest: 5656,
        totalAmountWithoutInterest: 5000,
        schedule: [
            new PaymentScheduleItemDto(
                month: 1,
                principalPayment: 833,
                interestPayment: 188,
                totalPayment: 1021,
                remainingPrincipal: 4167,
            ),
            new PaymentScheduleItemDto(
                month: 2,
                principalPayment: 833,
                interestPayment: 156,
                totalPayment: 990,
                remainingPrincipal: 3333,
            ),
            new PaymentScheduleItemDto(
                month: 3,
                principalPayment: 833,
                interestPayment: 125,
                totalPayment: 958,
                remainingPrincipal: 2500,
            ),
            new PaymentScheduleItemDto(
                month: 4,
                principalPayment: 833,
                interestPayment: 94,
                totalPayment: 927,
                remainingPrincipal: 1667,
            ),
            new PaymentScheduleItemDto(
                month: 5,
                principalPayment: 833,
                interestPayment: 63,
                totalPayment: 896,
                remainingPrincipal: 833,
            ),
            new PaymentScheduleItemDto(
                month: 6,
                principalPayment: 833,
                interestPayment: 31,
                totalPayment: 865,
                remainingPrincipal: 0,
            ),
        ],
    );
    expect($actualResult)->toEqual($expectedResult);
});

it('can resolve differentiated payment schedule with precision', function () {
    $resolver = new DifferentiatedResolver();
    $resolver->setPrecision(3);
    $actualResult = $resolver->resolve(6, 5000, 45);
    $expectedResult = new PaymentScheduleDto(
        totalAmountWithInterest: 5656.25,
        totalAmountWithoutInterest: 5000,
        schedule: [
            new PaymentScheduleItemDto(
                month: 1,
                principalPayment: 833.333,
                interestPayment: 187.5,
                totalPayment: 1020.833,
                remainingPrincipal: 4166.667,
            ),
            new PaymentScheduleItemDto(
                month: 2,
                principalPayment: 833.333,
                interestPayment: 156.25,
                totalPayment: 989.583,
                remainingPrincipal: 3333.333,
            ),
            new PaymentScheduleItemDto(
                month: 3,
                principalPayment: 833.333,
                interestPayment: 125,
                totalPayment: 958.333,
                remainingPrincipal: 2500,
            ),
            new PaymentScheduleItemDto(
                month: 4,
                principalPayment: 833.333,
                interestPayment: 93.75,
                totalPayment: 927.083,
                remainingPrincipal: 1666.667,
            ),
            new PaymentScheduleItemDto(
                month: 5,
                principalPayment: 833.333,
                interestPayment: 62.5,
                totalPayment: 895.833,
                remainingPrincipal: 833.333,
            ),
            new PaymentScheduleItemDto(
                month: 6,
                principalPayment: 833.333,
                interestPayment: 31.25,
                totalPayment: 864.583,
                remainingPrincipal: 0,
            ),
        ],
    );
    expect($actualResult)->toEqual($expectedResult);
});
