<?php

namespace App\Entities\Payments\UseCases\Interfaces;

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
