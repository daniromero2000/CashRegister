<?php

namespace Tests\Feature\app\Http\Controllers\Api\TransactionLogs;

use App\Models\CashRegister;
use App\Models\TransactionLog;
use App\Models\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

/**
 * Class TransactionLogControllerTest
 * @package Tests\Feature\app\Http\Controllers\Api\TransactionLogs
 * @author Danier Romero - 123romerod@gmail.com
 */
class TransactionLogControllerTest extends TestCase
{
    use WithoutMiddleware;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();

    }

    public function createDataForTests()
    {
        $cashRegister = factory(CashRegister::class)->create();

        $logs = factory(TransactionLog::class, 5)->create([
            'value' => $cashRegister->value
        ]);

        foreach ($logs as $log) {
            $cashRegister->transactionLogs()->attach($log,
                [
                    'cash_register_quantity' => $cashRegister->quantity,
                    'user_id' => $this->user->id
                ]);
        }

        return $logs;
    }

    /**
     * This function aims to simulate the return of a successful log list
     */
    public function testListTransactionLogSuccess(): void
    {
        $this->createDataForTests();

        $request = $this->actingAs($this->user)
            ->get(route('transactionLog.getLogs'));

        $request->assertStatus(200)->assertJsonStructure([
            'status',
            'message' => [
                [
                    'type',
                    'value',
                    'movements'
                ]
            ]
        ]);
    }

    /**
     * This function aims to simulate a server error when returning a list of records
     */
    public function testListTransactionLogError(): void
    {
        $request = $this->get(route('transactionLog.getLogs'), ['Accept' => 'application/json']);

        $request->assertStatus(500);
    }

    /**
     *This function aims to simulate the return of a list of records based on a successful date
     */
    public function testGetStatusByDateSuccess(): void
    {
        $data = $this->createDataForTests();
        $totalCashRegister = 0;

        foreach ($data as $log) {
            if ($log['type'] == 'cash_back') {
                $totalCashRegister -= $log['value'];
            }
            $totalCashRegister += $log['value'];
        }

        $request = $this
            ->actingAs($this->user)
            ->get(route('transactionLog.getStatusByDate', $log->created_at));

        $request->assertStatus(200)->assertJson([
            'status' => true,
            'message' => [
                'total_cash_register' => $totalCashRegister
            ]
        ]);
    }

    /**
     * This function aims to simulate an error in the server when returning a list of records based on a date
     */
    public function testGetStatusByDateError(): void
    {
        $request = $this->get(
            route('transactionLog.getStatusByDate', '2021-02-07 17:24:09'),
            ['Accept' => 'application/json']);

        $request->assertStatus(500);
    }

    /**
     *This function aims to simulate an error in the server when returning a list of records based on an invalid date.
     */
    public function testGetStatusByDateNotFound(): void
    {
        $request = $this->get(
            route('transactionLog.getStatusByDate', ''),
            ['Accept' => 'application/json']);

        $request->assertStatus(404);
    }

}
