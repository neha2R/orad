<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFielsToDemos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('demos', function (Blueprint $table) {
            $table->bigInteger('trainerid')->nullable()->change();
            $table->date('date')->nullable();
            $table->boolean('is_rescheduled')->default(0);
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
            $table->dropColumn('date');
            $table->dropColumn('is_rescheduled');
        });
    }
}
