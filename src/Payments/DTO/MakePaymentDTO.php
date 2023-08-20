<?php

namespace Novikov7ua\Packagios\Payments\DTO;

use Novikov7ua\Packagios\Enums\CurrencyEnum;
use Novikov7ua\Packagios\Enums\PaymentsEnum;

class MakePaymentDTO
{
    protected string $orderId;

    public function __construct(
        protected float $amount,
        protected CurrencyEnum $currency,
        protected PaymentsEnum $paymentsEnum,
        protected string $description = '',
    )
    {
    }

    public function getPaymentsEnum(): PaymentsEnum
    {
        return $this->paymentsEnum;
    }

    public function getOrderId(): string
    {
        return $this->orderId;
    }

    public function setOrderId(string $orderId): void
    {
        $this->orderId = $orderId;
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
