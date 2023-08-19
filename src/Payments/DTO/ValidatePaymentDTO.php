<?php

namespace Novikov7ua\Packagios\Payments\DTO;

class ValidatePaymentDTO
{
    public function __construct(
        protected string $orderId,
    )
    {
    }

}
