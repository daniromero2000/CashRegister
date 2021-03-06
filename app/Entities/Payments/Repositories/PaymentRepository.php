<?php

namespace App\Entities\Users\Entities\Payments\Repositories;

use App\Entities\Users\Entities\Payments\Payment;
use App\Entities\Users\Entities\Payments\Repositories\Interfaces\PaymentRepositoryInterface;

/**
 * Class PaymentRepository
 * @package App\Entities\Payments\Repositories
 * @author Daniel Romero - 123romerod@gmail.com
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
