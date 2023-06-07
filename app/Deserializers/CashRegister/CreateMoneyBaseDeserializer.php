<?php

namespace App\Deserializers\CashRegister;

use App\DataTransferObjects\CashRegister\CreateMoneyBaseDTO;

class CreateMoneyBaseDeserializer
{
    public function deserialize(array $data): CreateMoneyBaseDTO
    {
        return (new CreateMoneyBaseDTO())
            ->setValue($data['value'])
            ->setQuantity($data['quantity'])
            ->setDenomination($data['denomination']);
    }
}
