<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentPerformancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_performances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lead_id');
            $table->foreignId('qa_id');
            $table->date('date');
            $table->longText('topics');

            $table->integer('listening_marks')->nullable()->comment="maximum marks";
            $table->integer('listening_obtain')->nullable()->comment="obtaining marks";
            $table->integer('reading_marks')->nullable()->comment="maximum marks";
            $table->integer('reading_obtain')->nullable()->comment="obtaining marks";
            $table->integer('speaking_marks')->nullable()->comment="maximum marks";
            $table->integer('speaking_obtain')->nullable()->comment="obtaining marks";
            $table->integer('writing_marks')->nullable()->comment="maximum marks";
            $table->integer('writing_obtain')->nullable()->comment="obtaining marks";
            
            
            $table->float('avg_of_marks', 5,2)->nullable()->comment="average of maximum marks (total of max / 4)";
            $table->float('avg_of_obtain', 5,2)->nullable()->comment="average of obtain marks (total of obtain /4 )";
            $table->float('total', 5,2)->nullable()->comment="total percentage = avg_of_obtain / avg_of_marks * 100";
            $table->longText('feedback')->nullable()->comment="test feedback";
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
        Schema::dropIfExists('student_performances');
    }
}
