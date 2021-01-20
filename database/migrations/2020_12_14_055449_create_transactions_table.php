<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('staff_id')->unsigned();
            $table->enum('transaction_type', ['DEPOSIT','WITHDRAWAL','LOAN','INTEREST'])->nullable();
            $table->dateTime('transaction_date')->nullable();
            $table->double('amount');
            $table->double('balance');
            $table->timestamps();
            $table->softDeletes();
//         $table->foreign('staff_id')->references('staff_id')->on('staffs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('transactions');
    }
}
