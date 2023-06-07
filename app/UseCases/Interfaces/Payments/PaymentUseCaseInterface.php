<?php

namespace App\UseCases\Interfaces\Payments;

/**
 * Interface PaymentUseCaseInterface
 * @package App\Entities\Payments\UseCases\Interfaces
 */
interface PaymentUseCaseInterface
{
    /**
     * @param array $data
     * @return array
     */
    public function createPayment(array $data): array;
}
