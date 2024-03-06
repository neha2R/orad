<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImportedleadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('importedleads', function (Blueprint $table) {
            $table->id();
            $table->string('mobile');
            $table->boolean('optin');
            $table->longText('template')->nullable();
            $table->longText('responseoptin')->nullable();
            $table->longText('responsesendmessage')->nullable();
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
        Schema::dropIfExists('importedleads');
    }
}
