<?php

namespace Novikov7ua\Packagios\Payments;

use Exception;
use Novikov7ua\Packagios\Enums\PaymentsEnum;
use Novikov7ua\Packagios\Payments\DTO\PaymentDataDTO;
use Novikov7ua\Packagios\Payments\Module\PayPal\PaypalHandler;
use Illuminate\Contracts\Container\BindingResolutionException;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Throwable;


class PaymentFactory
{
    /**
     * @throws BindingResolutionException
     * @throws BindingResolutionException
     * @throws Throwable
     */
    public function getInstance(PaymentsEnum $paymentsEnum, $config): PaymentInterface
    {
        return match ($paymentsEnum)
        {
            PaymentsEnum::PAYPAL => new PaypalHandler(
                new PayPalClient(),
                new PaymentDataDTO(
                    $config['paypal']['client_id'],
                    $config['paypal']['client_secret'],
                    $config['paypal']['app_id'],
                    $config['paypal']['mode'],
                )
            ),
            PaymentsEnum::STRIPE => throw new Exception('To be implemented'),
        };
    }
}
