<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepositsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deposits', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('deposit_date');
            $table->integer('staff_id')->unsigned()->nullable();
            $table->integer('division_id')->unsigned()->nullable();
            $table->string('reference')->nullable();
            $table->string('description')->nullable();
            $table->double('amount');
            $table->integer('transaction_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('transaction_id')->references('id')->on('transactions');
//            $table->foreign('staff_id')->references('staff_id')->on('staffs');
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
        Schema::drop('deposits');
    }
}
