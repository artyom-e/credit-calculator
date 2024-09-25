<?php

declare(strict_types=1);

namespace ArtyomE\CreditCalculator\Resolvers;

use ArtyomE\CreditCalculator\DTO\PaymentScheduleDto;
use ArtyomE\CreditCalculator\DTO\PaymentScheduleItemDto;

/**
 * In this scheme, each payment consists of a fixed amount,
 * including both the principal and interest. Monthly payments remain
 * the same throughout the loan term.
 */
class AnnuityResolver extends AbstractResolver
{
    public function resolve(int $term, float $amount, float $yearlyPercentage): PaymentScheduleDto
    {
        $monthlyPayment = $this->resolveMonthlyPayment($term, $amount, $yearlyPercentage);
        $remainingPrincipal = $amount;
        $totalAmountWithPercent = 0;
        $totalAmountWithoutPercent = 0;

        $schedule = [];
        for ($month = 1; $month <= $term; $month++) {
            $interestPayment = $remainingPrincipal * $this->getMonthlyRate($yearlyPercentage);
            $principalPayment = $monthlyPayment - $interestPayment;
            $remainingPrincipal -= $principalPayment;
            $totalAmountWithPercent += $monthlyPayment;
            $totalAmountWithoutPercent += $principalPayment;

            $schedule[] = new PaymentScheduleItemDto(
                month: $month,
                principalPayment: $this->prepareFloat($principalPayment),
                interestPayment:  $this->prepareFloat($interestPayment),
                totalPayment:  $this->prepareFloat($monthlyPayment),
                remainingPrincipal: $remainingPrincipal > 0 ? $this->prepareFloat($remainingPrincipal) : 0,
            );
        }

        return new PaymentScheduleDto(
            totalAmountWithInterest:  $this->prepareFloat($totalAmountWithPercent),
            totalAmountWithoutInterest:  $this->prepareFloat($totalAmountWithoutPercent),
            schedule: $schedule
        );
    }

    private function resolveMonthlyPayment(int $term, float $amount, float $yearlyPercentage): float
    {
        $monthlyRate = $this->getMonthlyRate($yearlyPercentage);
        if ($monthlyRate <= 0) {
            return $amount / $term;
        }
        $annuityCoefficient = ($monthlyRate * pow(1 + $this->getMonthlyRate($yearlyPercentage), $term)) / (pow(1 + $monthlyRate, $term) - 1);

        return $amount * $annuityCoefficient;
    }
}
