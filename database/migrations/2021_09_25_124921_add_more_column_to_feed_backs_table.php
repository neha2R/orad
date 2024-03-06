<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMoreColumnToFeedBacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('feed_backs', function (Blueprint $table) {
            $table->enum('parent_attend',['0','1'])->default(0)->comment="0=no , 1=yes";
            $table->tinyText('course_like')->nullable()->comment="0=Okay, 1=Like etc. you can see other options in helper.php file";
            $table->date('call_date')->nullable()->comment="What time should the agent call the parent";
            $table->time('call_time')->nullable()->comment="What time should the agent call the parent";
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
            $table->dropColumn('parent_attend');
            $table->dropColumn('course_like');
            $table->dropColumn('call_date');
            $table->dropColumn('call_time');
        });
    }
}
