<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackagingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      if(!Schema::hasTable('packagings')){
        Schema::create('packagings', function (Blueprint $table) {
          $table->increments('id');
          $table->string('code')->nullable();
          $table->string('name')->nullable();
          $table->string('description')->nullable();
          $table->string('currency')->nullable();
          $table->integer('price')->nullable();
          $table->string('created_by')->nullable();
          $table->string('updated_by')->nullable();
          $table->string('deleted_by')->nullable();
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
        Schema::dropIfExists('packagings');
    }
}
