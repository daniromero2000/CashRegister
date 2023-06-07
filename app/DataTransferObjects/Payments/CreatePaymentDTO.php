<?php

namespace App\DataTransferObjects\Payments;

/**
 * Class CreatePaymentDTO
 * @package App\DataTransferObjects\CashRegister
 */
class CreatePaymentDTO
{
    private float $amount;

    private float $amountReceived;

    private string $denomination;

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     * @return CreatePaymentDTO
     */
    public function setAmount(float $amount): CreatePaymentDTO
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @return float
     */
    public function getAmountReceived(): float
    {
        return $this->amountReceived;
    }

    /**
     * @param float $amountReceived
     * @return CreatePaymentDTO
     */
    public function setAmountReceived(float $amountReceived): CreatePaymentDTO
    {
        $this->amountReceived = $amountReceived;
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
     * @return CreatePaymentDTO
     */
    public function setDenomination(string $denomination): CreatePaymentDTO
    {
        $this->denomination = $denomination;
        return $this;
    }

    public function serialize(): array
    {
        return [
            'customer_payment' => $this->getAmountReceived(),
            'amount_payable' => $this->getAmount(),
            'payment_denomination' => $this->getDenomination()
        ];
    }
}
