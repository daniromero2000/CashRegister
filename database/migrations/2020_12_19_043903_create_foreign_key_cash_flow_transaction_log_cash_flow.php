<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForeignKeyCashFlowTransactionLogCashFlow extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cash_flow_transaction_log', function (Blueprint $table) {
            $table->foreign('cash_flow_id')->references('id')->on('cash_flows');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cash_flow_transaction_log', function (Blueprint $table) {
            //
        });
    }
}
