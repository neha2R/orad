<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('demo_id')->default(0);
            $table->bigInteger('leadid')->default(0);
            $table->bigInteger('trainerid')->default(0);
            $table->date('class_date')->nullable();
            $table->bigInteger('slot')->default(0);
            $table->string('slotname')->nullable();
            $table->boolean('is_active')->default(1);
            $table->boolean('is_reschedule')->default(0);
            $table->mediumText('classlink')->nullable();
            $table->boolean('student_attend')->default(0);
            $table->boolean('trainer_attend')->default(0);
            $table->bigInteger('course_id')->nullable();
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
        Schema::dropIfExists('classes');
    }
}
