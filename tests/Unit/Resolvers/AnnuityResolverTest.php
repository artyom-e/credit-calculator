<?php

use ArtyomE\CreditCalculator\DTO\PaymentScheduleDto;
use ArtyomE\CreditCalculator\DTO\PaymentScheduleItemDto;
use ArtyomE\CreditCalculator\Resolvers\AnnuityResolver;

it('can resolve annuity payment schedule', function () {
    $resolver = new AnnuityResolver();
    $actualResult = $resolver->resolve(6, 5000, 45);
    $expectedResult = new PaymentScheduleDto(
        totalAmountWithInterest: 5676,
        totalAmountWithoutInterest: 5000,
        schedule: [
            new PaymentScheduleItemDto(
                month: 1,
                principalPayment: 759,
                interestPayment: 188,
                totalPayment: 946,
                remainingPrincipal: 4241,
            ),
            new PaymentScheduleItemDto(
                month: 2,
                principalPayment: 787,
                interestPayment: 159,
                totalPayment: 946,
                remainingPrincipal: 3454,
            ),
            new PaymentScheduleItemDto(
                month: 3,
                principalPayment: 817,
                interestPayment: 130,
                totalPayment: 946,
                remainingPrincipal: 2638,
            ),
            new PaymentScheduleItemDto(
                month: 4,
                principalPayment: 847,
                interestPayment: 99,
                totalPayment: 946,
                remainingPrincipal: 1791,
            ),
            new PaymentScheduleItemDto(
                month: 5,
                principalPayment: 879,
                interestPayment: 67,
                totalPayment: 946,
                remainingPrincipal: 912,
            ),
            new PaymentScheduleItemDto(
                month: 6,
                principalPayment: 912,
                interestPayment: 34,
                totalPayment: 946,
                remainingPrincipal: 0,
            ),
        ],
    );
    expect($actualResult)->toEqual($expectedResult);
});

it('can resolve annuity payment schedule with precision', function () {
    $resolver = new AnnuityResolver();
    $resolver->setPrecision(3);
    $actualResult = $resolver->resolve(6, 5000, 45);
    $expectedResult = new PaymentScheduleDto(
        totalAmountWithInterest: 5676.366,
        totalAmountWithoutInterest: 5000,
        schedule: [
            new PaymentScheduleItemDto(
                month: 1,
                principalPayment: 758.561,
                interestPayment: 187.5,
                totalPayment: 946.061,
                remainingPrincipal: 4241.439,
            ),
            new PaymentScheduleItemDto(
                month: 2,
                principalPayment: 787.007,
                interestPayment: 159.054,
                totalPayment: 946.061,
                remainingPrincipal: 3454.432,
            ),
            new PaymentScheduleItemDto(
                month: 3,
                principalPayment: 816.52,
                interestPayment: 129.541,
                totalPayment: 946.061,
                remainingPrincipal: 2637.912,
            ),
            new PaymentScheduleItemDto(
                month: 4,
                principalPayment: 847.139,
                interestPayment: 98.922,
                totalPayment: 946.061,
                remainingPrincipal: 1790.773,
            ),
            new PaymentScheduleItemDto(
                month: 5,
                principalPayment: 878.907,
                interestPayment: 67.154,
                totalPayment: 946.061,
                remainingPrincipal: 911.866,
            ),
            new PaymentScheduleItemDto(
                month: 6,
                principalPayment: 911.866,
                interestPayment: 34.195,
                totalPayment: 946.061,
                remainingPrincipal: 0,
            ),
        ],
    );
    expect($actualResult)->toEqual($expectedResult);
});
