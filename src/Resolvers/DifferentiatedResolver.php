<?php

declare(strict_types=1);

namespace ArtyomE\CreditCalculator\Resolvers;

use ArtyomE\CreditCalculator\DTO\PaymentScheduleDto;
use ArtyomE\CreditCalculator\DTO\PaymentScheduleItemDto;

/**
 * Under this scheme, each payment consists of a decreasing
 * portion of the principal amount and the interest accrued
 * on the remaining unpaid balance. As the principal amount decreases,
 * the interest portion of the payment also decreases.
 */
class DifferentiatedResolver extends AbstractResolver
{
    public function resolve(int $term, float $amount, float $yearlyPercentage): PaymentScheduleDto
    {
        $monthlyPrincipalPayment = $amount / $term;
        $schedule = [];
        $totalAmountWithInterest = 0;
        $totalAmountWithoutInterest = 0;

        for ($month = 1; $month <= $term; ++$month) {
            $remainingPrincipal = $amount - ($monthlyPrincipalPayment * $month);
            $interestPayment = ($amount - ($monthlyPrincipalPayment * ($month - 1))) * $this->getMonthlyRate($yearlyPercentage);
            $totalPayment = $monthlyPrincipalPayment + $interestPayment;
            $totalAmountWithInterest += $totalPayment;
            $totalAmountWithoutInterest += $monthlyPrincipalPayment;
            $schedule[] = new PaymentScheduleItemDto(
                month: $month,
                principalPayment: $this->prepareFloat($monthlyPrincipalPayment),
                interestPayment: $this->prepareFloat($interestPayment),
                totalPayment: $this->prepareFloat($totalPayment),
                remainingPrincipal: $remainingPrincipal > 0 ? $this->prepareFloat($remainingPrincipal) : 0,
            );
        }

        return new PaymentScheduleDto(
            totalAmountWithInterest: $this->prepareFloat($totalAmountWithInterest),
            totalAmountWithoutInterest: $this->prepareFloat($totalAmountWithoutInterest),
            schedule: $schedule
        );
    }
}
