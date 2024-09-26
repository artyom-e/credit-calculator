<?php

declare(strict_types=1);

namespace ArtyomE\CreditCalculator\Resolvers;

use ArtyomE\CreditCalculator\DTO\PaymentScheduleDto;
use ArtyomE\CreditCalculator\DTO\PaymentScheduleItemDto;

class BulletResolver extends AbstractResolver
{
    public function resolve(int $term, float $amount, float $yearlyPercentage): PaymentScheduleDto
    {
        $monthlyInterestPayment = $amount * $this->getMonthlyRate($yearlyPercentage);
        $schedule = [];
        $totalAmountWithInterest = $amount + $monthlyInterestPayment * $term;
        $remainingPrincipal = $totalAmountWithInterest;
        for ($month = 1; $month <= $term; $month++) {
            if ($month === $term) {
                $totalPayment = $amount + $monthlyInterestPayment;
                $remainingPrincipal -= $totalPayment;
                $schedule[] = new PaymentScheduleItemDto(
                    month: $month,
                    principalPayment: $this->prepareFloat($amount),
                    interestPayment: $this->prepareFloat($monthlyInterestPayment),
                    totalPayment: $this->prepareFloat($totalPayment),
                    remainingPrincipal: $this->prepareFloat($remainingPrincipal),
                );
            } else {
                $totalPayment = $monthlyInterestPayment;
                $remainingPrincipal -= $totalPayment;
                $schedule[] = new PaymentScheduleItemDto(
                    month: $month,
                    principalPayment: 0,
                    interestPayment: $this->prepareFloat($monthlyInterestPayment),
                    totalPayment: $this->prepareFloat($totalPayment),
                    remainingPrincipal: $this->prepareFloat($remainingPrincipal),
                );
            }
            //            $totalAmountWithInterest += $totalPayment;
        }

        return new PaymentScheduleDto(
            totalAmountWithInterest: $this->prepareFloat($totalAmountWithInterest),
            totalAmountWithoutInterest: $this->prepareFloat($amount),
            schedule: $schedule
        );
    }
}
