<?php

namespace App\UseCases\Interfaces\Payments;

use App\DataTransferObjects\Payments\CreatePaymentDTO;

/**
 * Interface PaymentUseCaseInterface
 * @package App\Entities\Payments\UseCases\Interfaces
 */
interface SavePaymentUseCaseInterface
{
    /**
     * @param CreatePaymentDTO $createPaymentDTO
     * @return array
     */
    public function handler(CreatePaymentDTO $createPaymentDTO): array;
}
