<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFeildsToCoursePayments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('course_payments', function (Blueprint $table) {
            $table->string('linkId')->nullable();
            $table->boolean('is_expired')->default(0);
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
            $table->dropColumn('linkId');
            $table->dropColumn('is_expired');
        });
    }
}
