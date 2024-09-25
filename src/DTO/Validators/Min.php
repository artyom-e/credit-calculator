<?php

declare(strict_types=1);

namespace ArtyomE\CreditCalculator\DTO\Validators;

use Attribute;
use Spatie\DataTransferObject\Validation\ValidationResult;
use Spatie\DataTransferObject\Validator;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
class Min implements Validator
{
    public function __construct(private int $min)
    {
    }

    public function validate(mixed $value): ValidationResult
    {
        if (is_string($value)) {
            return $this->validateString($value);
        }
        if (is_numeric($value)) {
            return $this->validateNumeric($value);
        }

        return ValidationResult::invalid("Invalid variable type.");
    }

    private function validateNumeric(float|int $value): ValidationResult
    {
        if ($value < $this->min) {
            return ValidationResult::invalid("Value should be greater than or equal to {$this->min}");
        }

        return ValidationResult::valid();
    }

    private function validateString(string $value): ValidationResult
    {
        $length = strlen($value);
        if ($length < $this->min) {
            return ValidationResult::invalid("Value length should be greater than or equal to {$this->min}");
        }

        return ValidationResult::valid();
    }
}
