<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDescriptionAndImageToCoursesTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('courses_types', function (Blueprint $table) {
            $table->string('carriculam_file')->after('course_id')->nullable()->comment="Image file";
            $table->longText('description')->after('name')->nullable()->comment="Course description";
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
            $table->dropColumn('carriculam_file');
            $table->dropColumn('description');
        });
    }
}
