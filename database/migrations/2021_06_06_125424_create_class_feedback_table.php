<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_feedback', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('feedback_type')->default(0);
            $table->longText('feedback')->nullable();
            $table->bigInteger('feedback_from')->nullable();
            $table->bigInteger('feedback_to')->nullable();
            $table->bigInteger('class_id')->nullable();
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
        Schema::dropIfExists('class_feedback');
    }
}
