<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVideoLinkColumnToFeedBacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('feed_backs', function (Blueprint $table) {
            $table->longText('video_link')->nullable()->comments="Demo video uploaded link(Drive link)";
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
            $table->dropColumn('video_link');
        });
    }
}
