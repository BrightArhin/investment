<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWithdrawalsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('withdrawals', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('withdrawal_date')->nullable();
            $table->integer('staff_id')->unsigned();
            $table->integer('division_id')->unsigned();
            $table->string('reference')->nullable();
            $table->string('description')->nullable();
            $table->double('amount')->nullable();
            $table->integer('transaction_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
//            $table->foreign('staff_id')->references('staff_id')->on('staffs');
            $table->foreign('transaction_id')->references('id')->on('transactions');
            $table->foreign('division_id')->references('id')->on('divisions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('withdrawals');
    }
}
