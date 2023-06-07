<?php

namespace App\Repositories\Interfaces\Payments;

use App\Models\Payment;

/**
 * Interface PaymentRepositoryInterface
 * @package App\Entities\Payments\Repositories\Interfaces
 */
interface PaymentRepositoryInterface
{

    /**
     * @param array $data
     * @return Payment
     */
    public function create(array $data): Payment;
}
