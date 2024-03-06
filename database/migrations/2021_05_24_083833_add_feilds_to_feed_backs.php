<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFeildsToFeedBacks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('feed_backs', function (Blueprint $table) {
            $table->boolean('demo_taken')->default(0);
            $table->mediumText('fathername')->nullable();
            $table->string('course')->nullable();
            $table->mediumText('reason')->nullable();
            $table->mediumText('fatheroccupation')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('feed_backs', function (Blueprint $table) {
            $table->dropColumn('demo_taken');
            $table->dropColumn('fathername');
            $table->dropColumn('course');
            $table->dropColumn('reason');
            $table->dropColumn('fatheroccupation');
        });
    }
}
