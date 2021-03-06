<?php

namespace App\Entities\Users\Entities\Payments\Repositories\Interfaces;

use App\Entities\Users\Entities\Payments\Payment;

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
    public function createPayment(array $data): Payment;
}
