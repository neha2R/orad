<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewFieldsToCoursesTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('courses_types', function (Blueprint $table) {
            $table->string('no_of_classes')->after('name')->nullable();
            $table->integer('discount')->after('price')->nullable()->comment="discount given by admin";
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
            $table->dropColumn('no_of_classes');
            $table->dropColumn('discount');
        });
    }
}
