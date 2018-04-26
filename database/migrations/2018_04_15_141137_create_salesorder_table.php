<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesorderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->string('client');
            $table->string('product');
            $table->string('type');
            $table->string('code');
            $table->string('total');
            $table->string('packaging');
            $table->string('amount');
            $table->string('package');
            $table->string('realisasi');
            $table->string('stockk');
            $table->string('pending');
            $table->string('balance');
            $table->string('pendingpr');
            $table->string('note');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('salesorder');
    }
}
