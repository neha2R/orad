<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeedBacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feed_backs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('leadstatus')->nullable();
            $table->bigInteger('demoid')->nullable();
            $table->bigInteger('feedback_from')->nullable();
            $table->bigInteger('feedback_to')->nullable();
            $table->tinyInteger('feedback_type')->default(0);
            $table->tinyInteger('rating')->default(0);
            $table->longText('comment')->nullable();
            $table->string('behaviour')->nullable();
            $table->string('interested')->nullable();
            $table->date('prefereddate')->nullable();
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
        Schema::dropIfExists('feed_backs');
    }
}
