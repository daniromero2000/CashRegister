<?php

namespace App\DataTransferObjects\CashRegister;

/**
 * Class CreateMoneyBaseDTO
 * @package App\DataTransferObjects\CashRegister
 */
class CreateMoneyBaseDTO
{
    private float $value;

    private int $quantity;

    private string $denomination;

    /**
     * @return float
     */
    public function getValue(): float
    {
        return $this->value;
    }

    /**
     * @param float $value
     * @return CreateMoneyBaseDTO
     */
    public function setValue(float $value): CreateMoneyBaseDTO
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     * @return CreateMoneyBaseDTO
     */
    public function setQuantity(int $quantity): CreateMoneyBaseDTO
    {
        $this->quantity = $quantity;
        return $this;
    }

    /**
     * @return string
     */
    public function getDenomination(): string
    {
        return $this->denomination;
    }

    /**
     * @param string $denomination
     * @return CreateMoneyBaseDTO
     */
    public function setDenomination(string $denomination): CreateMoneyBaseDTO
    {
        $this->denomination = $denomination;
        return $this;
    }

    public function serialize(): array {
        return [
            'value' => $this->getValue(),
            'quantity' => $this->getQuantity(),
            'denomination' => $this->getDenomination()
        ];
    }
}
