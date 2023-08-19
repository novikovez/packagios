<?php

namespace Novikov7ua\Packagios\Payments\DTO;

use Novikov7ua\Packagios\Enums\CurrencyEnum;

class MakePaymentDTO
{
    public function __construct(
        protected float $amount,
        protected CurrencyEnum $currency,
        protected string $description = '',
    )
    {
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @return CurrencyEnum
     */
    public function getCurrency(): CurrencyEnum
    {
        return $this->currency;
    }
}
