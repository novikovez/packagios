<?php

namespace Novikov7ua\Packagios\Payments\Module\PayPal;

use Novikov7ua\Packagios\Enums\CurrencyEnum;
use Novikov7ua\Packagios\Enums\PaymentStatusEnum;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Throwable;

class GetPaymentInfoService
{
    /**
     * @throws Throwable
     */
    public function handle(PayPalClient $payPalClient, string $paymentId): object
    {
        $response = $payPalClient->capturePaymentOrder($paymentId);
        if(isset($response['error'])) {
            return (object)[
                'success' => false,
                'status' => PaymentStatusEnum::getValueId($response['error']['details'][0]['issue']),
                'description' => $response['error']['details'][0]['description'],
            ];

        }

        return (object)[
            'success' => true,
            'paymentId' => $response['purchase_units'][0]['payments']['captures'][0]['id'],
            'orderId' => $response['id'],
            'status' => PaymentStatusEnum::getValueId($response['status']),
            'email' => $response['payment_source']['paypal']['email_address'],
            'amount' => $response['purchase_units'][0]['payments']['captures'][0]['amount']['value'],
            'currency' => CurrencyEnum::getValueId(
                $response['purchase_units'][0]['payments']['captures'][0]['amount']['currency_code']
            )
        ];
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
