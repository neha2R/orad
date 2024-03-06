<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDiscountedPriceColomToCoursesTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('courses_types', function (Blueprint $table) {
            $table->string('total_discount')->after('discount')->default(0)->comment="total discount price in rs";
            $table->string('discounted_price')->after('total_discount')->default(0);
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
            $table->dropColumn('total_discount');
            $table->dropColumn('discounted_price');
        });
    }
}
