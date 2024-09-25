<?php

declare(strict_types=1);

namespace ArtyomE\CreditCalculator\DTO;

use Spatie\DataTransferObject\Attributes\CastWith;
use Spatie\DataTransferObject\Attributes\MapTo;
use Spatie\DataTransferObject\Casters\ArrayCaster;
use Spatie\DataTransferObject\DataTransferObject;

class PaymentScheduleDto extends DataTransferObject
{
    #[MapTo('total_amount_with_interest')]
    public float $totalAmountWithInterest;

    #[MapTo('total_amount_without_interest')]
    public float $totalAmountWithoutInterest;

    #[MapTo('avg_monthly_payment')]
    public float $avgMonthlyPayment;

    /** @var PaymentScheduleItemDto[] */
    #[CastWith(ArrayCaster::class, itemType: PaymentScheduleItemDto::class)]
    public array $schedule;
}
