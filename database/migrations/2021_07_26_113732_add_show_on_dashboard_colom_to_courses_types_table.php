<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddShowOnDashboardColomToCoursesTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('courses_types', function (Blueprint $table) {
            $table->enum('show_on_dashboard',['0','1'])->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('courses_types', function (Blueprint $table) {
            $table->dropColumn('show_on_dashboard');
        });
    }
}
