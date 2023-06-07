<?php

namespace App\Deserializers\Payments;

use App\DataTransferObjects\Payments\CreatePaymentDTO;

/**
 * Class CreatePaymentDeserializer
 * @package App\Deserializers\Payments
 */
class CreatePaymentDeserializer
{
    public function deserialize(array $data): CreatePaymentDTO
    {
        return (new CreatePaymentDTO())
            ->setAmount($data['amount'])
            ->setDenomination($data['denomination'])
            ->setAmountReceived($data['amount_received']);
    }
}
