<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSurveyColomCoursePaymentToCoursePayments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('course_payments', function (Blueprint $table) {
            $table->string('survey')->default(1)->comment="0=Directly pay through website 1=converted lead by staff";
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('course_payments', function (Blueprint $table) {
            $table->dropColumn('survey');
        });
    }
}
