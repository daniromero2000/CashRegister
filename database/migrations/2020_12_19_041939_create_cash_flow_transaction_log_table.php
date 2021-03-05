<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashFlowTransactionLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cash_flow_transaction_log', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cash_flow_id');
            $table->unsignedBigInteger('transaction_log_id');
            $table->integer('cash_flow_count');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cash_flow_transaction_log');
    }
}
