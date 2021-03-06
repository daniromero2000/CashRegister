<?php

namespace App\Entities\Payments\Repositories;

use App\Entities\Payments\Payment;
use App\Entities\Payments\Repositories\Interfaces\PaymentRepositoryInterface;

/**
 * Class PaymentRepository
 * @package App\Entities\Payments\Repositories
 */
class PaymentRepository implements PaymentRepositoryInterface
{
    /**
     * @var Payment
     */
    private $payment;

    public function __construct(Payment $payment)
    {
        $this->payment = $payment;
    }

    /**
     * @param array $data
     * @return Payment
     */
    public function createPayment(array $data): Payment
    {
        return $this->payment->create($data);
    }
}
