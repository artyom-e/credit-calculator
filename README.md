# PHP Credit Calculator Package

A simple PHP-based Credit Calculator that supports two types of loan payment calculations:
- **Annuity Payments**
- **Differentiated Payments**

## Features

- **Annuity Calculation**: Fixed monthly payments throughout the loan period.
- **Differentiated Calculation**: Payments decrease over time, starting with higher amounts.

## Requirements

- PHP 8.3 or higher

## Installation

```bash
composer require artyom-e/credit-calculator
```

## Usage

```php
use ArtyomE\CreditCalculator\ResolverFactory;
use ArtyomE\CreditCalculator\Enums\CalculationType;

$resolver = ResolverFactory::createResolver(CalculationType::annuity);

$paymentSchedule = $resolver->resolve(6, 5000, 45);
```

### Result

```json
{
   "total_amount_with_interest":5676,
   "total_amount_without_interest":5000,
   "schedule":[
      {
         "month":1,
         "principal_payment":759,
         "interest_payment":188,
         "total_payment":946,
         "remaining_principal":4241
      },
      {
         "month":2,
         "principal_payment":787,
         "interest_payment":159,
         "total_payment":946,
         "remaining_principal":3454
      },
      {
         "month":3,
         "principal_payment":817,
         "interest_payment":130,
         "total_payment":946,
         "remaining_principal":2638
      },
      {
         "month":4,
         "principal_payment":847,
         "interest_payment":99,
         "total_payment":946,
         "remaining_principal":1791
      },
      {
         "month":5,
         "principal_payment":879,
         "interest_payment":67,
         "total_payment":946,
         "remaining_principal":912
      },
      {
         "month":6,
         "principal_payment":912,
         "interest_payment":34,
         "total_payment":946,
         "remaining_principal":0
      }
   ]
}
```

## TODO

- [ ] Add additional resolvers
