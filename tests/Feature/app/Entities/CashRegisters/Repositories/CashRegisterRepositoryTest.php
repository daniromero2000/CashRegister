<?php

namespace Tests\Feature\app\Entities\CashRegisters\Repositories;

use App\Entities\CashRegisters\CashRegister;
use App\Entities\CashRegisters\Repositories\CashRegisterRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class CashRegisterRepositoryTest
 * @package Tests\Feature\app\Entities\CashRegisters\Repositories
 * @author Daniel Romero - 123romerod@gmail.com
 */
class CashRegisterRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
    }

    public function testCreateOrUpdateCashRegisterSuccess(): void
    {
        $cashRegister = factory(CashRegister::class)->create()->toArray();

        $cashRegisterRepository = new CashRegisterRepository(new CashRegister());
        $request = $cashRegisterRepository->createOrUpdateCashRegister($cashRegister);

        $cashRegister['quantity'] = $request->quantity;

        $this->assertDatabaseHas('cash_registers', $cashRegister);
    }
}
