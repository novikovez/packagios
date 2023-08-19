<?php

namespace Novikov7ua\Packagios\Payments\DTO;

use Novikov7ua\Packagios\Enums\CurrencyEnum;
use Novikov7ua\Packagios\Enums\PaymentsEnum;
use Novikov7ua\Packagios\Enums\PaymentStatusEnum;
use App\Http\Services\Payments\Factory\DTO\PayerDTO;

class PaymentInfoDTO
{
    public function __construct(
        protected PaymentStatusEnum $status,
        protected PaymentsEnum $paymentSystem,
        protected string $orderId,
        protected string $paymentId,
        protected string $amount,
        protected CurrencyEnum $currency,
        protected int $time,
        protected ?PayerDTO $payer,
    ) {
    }

    public function getStatus(): PaymentStatusEnum
    {
        return $this->status;
    }

    public function getPaymentSystem(): PaymentsEnum
    {
        return $this->paymentSystem;
    }

    public function getOrderId(): string
    {
        return $this->orderId;
    }

    public function getPaymentId(): string
    {
        return $this->paymentId;
    }

    public function getAmount(): string
    {
        return $this->amount;
    }

    public function getCurrency(): CurrencyEnum
    {
        return $this->currency;
    }

    public function getTime(): int
    {
        return $this->time;
    }

    public function getPayer(): ?PayerDTO
    {
        return $this->payer;
    }
}