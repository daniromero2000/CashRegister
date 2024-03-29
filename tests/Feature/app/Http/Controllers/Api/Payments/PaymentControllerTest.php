<?php

namespace Tests\Feature\app\Http\Controllers\Api\Payments;

use App\Models\CashRegister;
use App\Models\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

/**
 * Class PaymentControllerTest
 * @package Tests\Feature\app\Http\Controllers\Api\Payments
 * @author Daniel Romero - 123romerod@gmail.com
 */
class PaymentControllerTest extends TestCase
{
    use WithoutMiddleware;

    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
    }

    /**
     * This function aims to simulate a validation error when making a payment
     */
    public function testCreatePaymentErrorFields(): void
    {
        $data = [];

        $request = $this->post(route('payment.create'), $data, ['Accept' => 'application/json']);

        $request->assertStatus(422)
            ->assertJson([
                'message' => [
                    'amount_received' => [
                        'The amount received field is required.'
                    ],
                    'amount' => [
                        'The amount field is required.'
                    ],
                    'denomination' => [
                        'The denomination field is required.'
                    ]
                ]
            ]);
    }

    /**
     * This function aims to simulate a successful payment
     */
    public function testCreatePaymentSuccess(): void
    {
        $user = factory(User::class)->create();

        factory(CashRegister::class, 100)->create();

        $data = [
            'amount_received' => '50000',
            'amount' => '10000',
            'denomination' => 'bill'
        ];

        $request = $this->actingAs($user)
            ->postJson(route('payment.create'), $data);

        $request->assertStatus(200);
    }

    /**
     * This function aims to simulate a server error when making a payment and there is no user in session
     */
    public function testCreatePaymentErrorNotUser(): void
    {
        $data = [
            'amount_received' => '50000',
            'amount' => '20000',
            'denomination' => 'bill'
        ];

        $request = $this->post(route('payment.create'), $data, ['Accept' => 'application/json']);

        $request->assertStatus(500);
    }

    /**
     * This function aims to simulate a server error when making a payment and there is no money to return
     */
    public function testCreatePaymentErrorNotReturnCash(): void
    {
        factory(CashRegister::class, 1)->create();

        $data = [
            'amount_received' => '50000',
            'amount' => '10000',
            'denomination' => 'bill'
        ];

        $request = $this->post(route('payment.create'), $data, ['Accept' => 'application/json']);

        $request->assertStatus(500);
    }
}
