<?php

namespace Tests\Feature\app\Http\Controllers\Api\CashRegisters;

use App\Models\CashRegister;
use App\Models\User;
use App\Repositories\Interfaces\CashRegisters\CashRegisterRepositoryInterface;
use Exception;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use InvalidArgumentException;
use Mockery;
use Tests\TestCase;

/**
 * Class CashRegisterControllerTest
 * @package Tests\Feature\app\Http\Controllers\Api\CashRegisters
 * @author Daniel Romero - 123romerod@gmail.com
 */
class CashRegisterControllerTest extends TestCase
{
    use WithoutMiddleware;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
    }

    /**
     * This function aims to simulate the creation of the cash register's money base
     */
    public function testCreateMoneyBaseCashSuccess(): void
    {
        $data = [
            'denomination' => 'bill',
            'value' => '50000',
            'quantity' => '1'
        ];

        $response = $this->actingAs($this->user)
            ->postJson(route('cashRegister.create'), $data);

        $response->assertStatus(200);
        $this->assertDatabaseHas('cash_registers', $data);
    }

    /**
     * This function aims to simulate a validation error when creating the monetary base of the cash register
     */
    public function testCreateMoneyBaseCashRegisterErrorFields(): void
    {
        $data = [];

        $request = $this->post(route('cashRegister.create'), $data, ['Accept' => 'application/json']);

        $request->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'denomination' => [
                        'The denomination field is required.'
                    ],
                    'value' => [
                        'The value field is required.'
                    ],
                    'quantity' => [
                        'The quantity field is required.'
                    ]
                ]
            ]);
    }

    /**
     * @throws InvalidArgumentException
     * This function aims to simulate a server error when creating the cash register of the cash register
     */
    public function testCreateMoneyBaseCashRegisterError(): void
    {
        $data = [
            'denomination' => 'bill',
            'value' => '50000',
            'quantity' => '1'
        ];

        $cashRegisterMock = Mockery::mock(CashRegisterRepositoryInterface::class);
        $cashRegisterMock->shouldReceive('findByByDenominationAndValue')
            ->withArgs($data)
            ->andThrow(new Exception('data error'))
            ->getMock();

        $this->app->instance(CashRegisterRepositoryInterface::class, $cashRegisterMock);

        $request = $this->post(route('cashRegister.create'), $data, ['Accept' => 'application/json']);

        $request->assertStatus(500);
    }

    /**
     *  This function aims to simulate a successful query of the cash register status
     */
    public function testCheckStatusCashRegisterSuccess(): void
    {
        factory(CashRegister::class, 10)->create();
        $request = $this->get(route('cashRegister.getStatus'), ['Accept' => 'application/json']);

        $request->assertStatus(200)->assertJsonStructure([
            'status',
            'message' => [
                'total_cash_register',
                'coin',
                'total_coin',
                'bill',
                'total_bill'
            ]
        ]);
    }

    /**
     * This function aims to simulate the action of emptying the cash register successfully
     */
    public function testWithdrawAllMoneyCashRegisterSuccess(): void
    {
        factory(CashRegister::class, 10)->create();

        $request = $this->get(route('cashFlow.withdrawAllMoney'), ['Accept' => 'application/json']);

        $request->assertStatus(200);
    }

    /**
     * This function is intended to simulate an error when emptying the cash register
     */
    public function testWithdrawAllMoneyCashRegisterError(): void
    {
        $request = $this->get(route('cashFlow.withdrawAllMoney'), ['Accept' => 'application/json']);

        $request->assertStatus(500);
    }
}
