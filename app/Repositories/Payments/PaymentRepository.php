<?php

namespace App\Repositories\Payments;

use App\Models\Payment;
use App\Repositories\Interfaces\Payments\PaymentRepositoryInterface;

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
    public function create(array $data): Payment
    {
        return $this->payment->create($data);
    }
}
