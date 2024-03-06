<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStudentFeedbackToFeedBacks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('demos', function (Blueprint $table) {
            $table->tinyInteger('student_feedback')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('demos', function (Blueprint $table) {
            $table->dropColumn('student_feedback');
        });
    }
}
