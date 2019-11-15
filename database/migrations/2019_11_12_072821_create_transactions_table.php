<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->string('name');
            $table->string('phone');
            $table->text('address')->nullable();
            $table->date('date');
            $table->json('items');
            $table->string('payment_option');
            $table->integer('total');
            $table->integer('food')->default('0');
            $table->integer('drink')->default('0');
            $table->integer('food_total')->default('0');
            $table->integer('drink_total')->default('0');
            $table->nullableTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
