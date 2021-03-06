<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForeignKeyCashRegisterTransactionLogCashRegister extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cash_register_transaction_log', function (Blueprint $table) {
            $table->foreign('cash_register_id')->references('id')->on('cash_registers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cash_register_transaction_log', function (Blueprint $table) {
            //
        });
    }
}
