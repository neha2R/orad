<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->comment="scholarship user id";
            $table->foreignId('exam_id');
            $table->time('submit_time');
            $table->integer('total_questions')->comment="no of total questions";
            $table->integer('right_answers')->comment="no of right answers";
            $table->enum('result',['0','1'])->comment="0=fail, 1=pass";
            $table->float('percentage',8,2);
            $table->enum('is_active',['0','1'])->default('1');
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
        Schema::dropIfExists('exam_results');
    }
}
