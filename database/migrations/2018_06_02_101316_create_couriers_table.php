<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouriersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      if(!Schema::hasTable('couriers')){
        Schema::create('couriers', function (Blueprint $table) {
          $table->increments('id');
          $table->string('name')->nullable();
          $table->string('currency')->nullable();
          $table->integer('price')->nullable();
          $table->string('status')->nullable();
          $table->timestamps();
          $table->softDeletes();
        });
      }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('couriers');
    }
}
