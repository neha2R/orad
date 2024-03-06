<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPostColomToEmployeeOfTheMonthsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employee_of_the_months', function (Blueprint $table) {
            $table->string('post')->after('photo')->default('tranner');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employee_of_the_months', function (Blueprint $table) {
            $table->dropColumn('post');
        });
    }
}
