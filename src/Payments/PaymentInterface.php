<?php

namespace Novikov7ua\Packagios\Payments;

use Novikov7ua\Packagios\Payments\DTO\MakePaymentDTO;

interface PaymentInterface
{

    public function getPaymentInfo(string $paymentId);
    public function createPayment(MakePaymentDTO $paymentDTO): string;
}
