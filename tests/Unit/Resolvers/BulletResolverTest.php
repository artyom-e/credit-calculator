<?php

use ArtyomE\CreditCalculator\DTO\PaymentScheduleDto;
use ArtyomE\CreditCalculator\DTO\PaymentScheduleItemDto;
use ArtyomE\CreditCalculator\Resolvers\BulletResolver;

it('can resolve bullet payment schedule', function () {
    $resolver = new BulletResolver();
    $actualResult = $resolver->resolve(6, 5000, 45);
    $expectedResult = new PaymentScheduleDto(
        totalAmountWithInterest: 6125,
        totalAmountWithoutInterest: 5000,
        schedule: [
            new PaymentScheduleItemDto(
                month: 1,
                principalPayment: 0,
                interestPayment: 188,
                totalPayment: 188,
                remainingPrincipal: 5938,
            ),
            new PaymentScheduleItemDto(
                month: 2,
                principalPayment: 0,
                interestPayment: 188,
                totalPayment: 188,
                remainingPrincipal: 5750,
            ),
            new PaymentScheduleItemDto(
                month: 3,
                principalPayment: 0,
                interestPayment: 188,
                totalPayment: 188,
                remainingPrincipal: 5563,
            ),
            new PaymentScheduleItemDto(
                month: 4,
                principalPayment: 0,
                interestPayment: 188,
                totalPayment: 188,
                remainingPrincipal: 5375,
            ),
            new PaymentScheduleItemDto(
                month: 5,
                principalPayment: 0,
                interestPayment: 188,
                totalPayment: 188,
                remainingPrincipal: 5188,
            ),
            new PaymentScheduleItemDto(
                month: 6,
                principalPayment: 5000,
                interestPayment: 188,
                totalPayment: 5188,
                remainingPrincipal: 0,
            ),
        ],
    );
    expect($actualResult)->toEqual($expectedResult);
});

it('can resolve bullet payment schedule with precision', function () {
    $resolver = new BulletResolver();
    $resolver->setPrecision(3);
    $actualResult = $resolver->resolve(6, 5000, 45);
    $expectedResult = new PaymentScheduleDto(
        totalAmountWithInterest: 6125,
        totalAmountWithoutInterest: 5000,
        schedule: [
            new PaymentScheduleItemDto(
                month: 1,
                principalPayment: 0,
                interestPayment: 187.5,
                totalPayment: 187.5,
                remainingPrincipal: 5937.5,
            ),
            new PaymentScheduleItemDto(
                month: 2,
                principalPayment: 0,
                interestPayment: 187.5,
                totalPayment: 187.5,
                remainingPrincipal: 5750,
            ),
            new PaymentScheduleItemDto(
                month: 3,
                principalPayment: 0,
                interestPayment: 187.5,
                totalPayment: 187.5,
                remainingPrincipal: 5562.5,
            ),
            new PaymentScheduleItemDto(
                month: 4,
                principalPayment: 0,
                interestPayment: 187.5,
                totalPayment: 187.5,
                remainingPrincipal: 5375,
            ),
            new PaymentScheduleItemDto(
                month: 5,
                principalPayment: 0,
                interestPayment: 187.5,
                totalPayment: 187.5,
                remainingPrincipal: 5187.5,
            ),
            new PaymentScheduleItemDto(
                month: 6,
                principalPayment: 5000,
                interestPayment: 187.5,
                totalPayment: 5187.5,
                remainingPrincipal: 0,
            ),
        ],
    );
    expect($actualResult)->toEqual($expectedResult);
});
