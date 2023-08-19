<?php

namespace Novikov7ua\Packagios\Payments\Module\PayPal;
use Novikov7ua\Packagios\Enums\CurrencyEnum;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Novikov7ua\Packagios\Payments\DTO\MakePaymentDTO;
use Throwable;

class CreatePaymentService
{
    /**
     * @throws Throwable
     */
    public function handle(PayPalClient $payPal, MakePaymentDTO $paymentDTO): string
    {
        $response = $payPal->createOrder([
            "intent" => "CAPTURE",
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => $this->getCurrency($paymentDTO->getCurrency()),
                        "value" => number_format($paymentDTO->getAmount(), 2)
                    ]
                ]
            ]
        ]);
        if(isset($response['id']) && $response['id'] != null)
        {
            return $response['id'];
        }
        return '';
    }

    private function getCurrency(CurrencyEnum $currencyEnum): string
    {
        return match ($currencyEnum)
        {
            CurrencyEnum::USD => 'USD',
            CurrencyEnum::EUR => 'EUR'
        };
    }
}