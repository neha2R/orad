<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('state')->nullable();
            $table->integer('refrence')->nullable();
            $table->tinyInteger('growth')->default(1);
            $table->tinyInteger('edulevel')->default(1);
            $table->boolean('gender')->default(1);
            $table->longText('comments')->nullable();
            $table->json('langaugesknown')->nullable();
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
        Schema::dropIfExists('user_details');
    }
}
