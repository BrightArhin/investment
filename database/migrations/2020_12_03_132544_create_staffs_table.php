<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staffs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('department_id')->unsigned();
            $table->integer('division_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->integer('staff_id')->unsigned();
//            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('department_id')->references('id')->on('departments');
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
        Schema::drop('members');
    }
}
