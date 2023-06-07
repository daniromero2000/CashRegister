<?php

namespace App\UseCases\Payments;

use App\DataTransferObjects\Payments\CreatePaymentDTO;
use App\Exceptions\Payments\InsufficientFoundsException;
use App\Repositories\Interfaces\CashRegisters\CashRegisterRepositoryInterface;
use App\Repositories\Interfaces\Payments\PaymentRepositoryInterface;
use App\Repositories\Interfaces\TransactionLogs\TransactionLogRepositoryInterface;
use App\UseCases\CashRegisters\ObtainCashRegisterUseCase;
use App\UseCases\Interfaces\Payments\SavePaymentUseCaseInterface;
use Illuminate\Support\Collection;

/**
 * Class PaymentUseCase
 * @package App\Entities\Payments\UseCases
 * @author Daniel Romero - 123romerod@gmail.com
 */
class SaveSavePaymentUseCase implements SavePaymentUseCaseInterface
{
    public function __construct(
        private PaymentRepositoryInterface $paymentRepository,
        private CashRegisterRepositoryInterface $cashRegisterRepository,
        private TransactionLogRepositoryInterface $transactionLogRepository,
        private ObtainCashRegisterUseCase $obtainCashRegisterUseCase
    )
    {
    }

    /**
     * @param CreatePaymentDTO $createPaymentDTO
     * @return array
     */
    public function handler(CreatePaymentDTO $createPaymentDTO): array
    {
        $checkCashReturn = $this->getTotalReturned(
            $createPaymentDTO->getAmountReceived(),
            $createPaymentDTO->getAmount()
        );

        if (empty($checkCashReturn)) {
            throw new InsufficientFoundsException();
        }

        $payment = $createPaymentDTO->serialize();
        $payment['total_returned'] = $checkCashReturn['total_returned'];
        $this->paymentRepository->create($payment);

        $dataCreate = [
            'denomination' => $createPaymentDTO->getDenomination(),
            'value' => $createPaymentDTO->getAmountReceived(),
            'quantity' => 1
        ];

        $this->createCashRegisterAndLog($dataCreate, 'payment', 'sum');

        foreach ($checkCashReturn['data'] as $key => $value) {
            $this->createCashRegisterAndLog($value, 'cash_back', 'rest');
        }

        $checkCashReturn['data'] = array_values($checkCashReturn['data']);

        return ['status' => true, 'message' => $checkCashReturn];
    }

    /**
     * @param array $data
     * @param string $type
     * @param string $operator
     * @return void
     */
    private function createCashRegisterAndLog(array $data, string $type, string $operator): void
    {
        $cashRegister = $this->obtainCashRegisterUseCase->handler([
            'denomination' => $data['denomination'],
            'value' => $data['value'],
            'quantity' => $data['quantity']
        ], $operator);

        $log = $this->transactionLogRepository->create(
            [
                'type' => $type,
                'value' => $data['value']
            ]);

        $cashRegister->transactionLogs()->attach($log,
            [
                'cash_register_quantity' => $data['quantity'],
                'user_id' => auth()->user()->id
            ]);
    }

    /**
     * @param int $amount
     * @param int $pay
     * @return array
     */
    private function getTotalReturned(int $pay, int $amount): array
    {
        $cashReturn = $pay - $amount;
        $data = [
            'total_returned' => $cashReturn,
            'data' => []
        ];

        /** @var Collection $list */
        $list = $this->cashRegisterRepository->list(
            ['column' => 'quantity', 'operator' => '>', 'value' => 0]
        );

        if ($list->isEmpty()) {
            return [];
        }

        $flag = true;

        while ($cashReturn > 0 && $flag) {
            $remaining = $cashReturn;

            foreach ($list as $cashRegister) {
                if ($cashRegister->quantity == 0 && $cashReturn < $cashRegister->value) {
                    continue;
                }

                $quantity = 1;
                $cashReturn = $cashReturn - $cashRegister->value;

                if (isset($data['data'][$cashRegister->value])) {
                    $quantity = $data['data'][$cashRegister->value]['quantity'] + 1;
                }

                $data['data'][$cashRegister->value] = [
                    'denomination' => $cashRegister->denomination,
                    'value' => $cashRegister->value,
                    'quantity' => $quantity
                ];

                $cashRegister->quantity -= 1;

                break;
            }

            if ($remaining == $cashReturn) {
                $flag = false;
            }
        }

        if (!$flag) {
            $data = [];
        }

        return $data;
    }
}
