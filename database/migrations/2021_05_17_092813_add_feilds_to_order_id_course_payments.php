<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFeildsToOrderIdCoursePayments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('course_payments', function (Blueprint $table) {
            $table->string('order_id')->nullable();
            $table->bigInteger('course_parent_id')->default(0);
            $table->bigInteger('course_id')->default(0);
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
            $table->dropColumn('order_id');
            $table->dropColumn('course_parent_id');
            $table->dropColumn('course_id');
        });
    }
}
