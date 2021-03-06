<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForeignKeyCashRegisterTransactionLogLogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cash_register_transaction_log', function (Blueprint $table) {
            $table->foreign('transaction_log_id')->references('id')->on('transaction_logs');
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
