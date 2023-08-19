<?php

namespace Novikov7ua\Packagios\Payments\Module\PayPal;

use Novikov7ua\Packagios\Payments\DTO\MakePaymentDTO;
use Novikov7ua\Packagios\Payments\DTO\PaymentDataDTO;
use Novikov7ua\Packagios\Payments\PaymentInterface;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Throwable;

class PaypalHandler implements PaymentInterface
{
    /**
     * @throws Throwable
     */
    public function __construct(
        protected PayPalClient $payPalClient,
        protected PaymentDataDTO $paymentDataDTO,
    )
    {
        $this->payPalClient->setApiCredentials([
            'mode' => $this->paymentDataDTO->getMode(),
            'client_id' => $this->paymentDataDTO->getClientId(),
            'client_secret' => $this->paymentDataDTO->getClientSecret(),
            'app_id' => $this->paymentDataDTO->getAppId(),
            'payment_action' => 'Sale',
            'currency' => 'USD',
            'notify_url' => '',
            'locale' => 'en_US',
            'validate_ssl' => true,
        ]);
        $this->payPalClient->getAccessToken();
    }

    /**
     * @throws Throwable
     */
    public function getPaymentInfo(string $paymentId): object
    {
        return (new GetPaymentInfoService())->handle($this->payPalClient, $paymentId);
    }


    /**
     * @throws Throwable
     */
    public function createPayment(MakePaymentDTO $paymentDTO): string
    {
        return (new CreatePaymentService())->handle($this->payPalClient, $paymentDTO);
    }
}
