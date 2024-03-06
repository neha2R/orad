<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTitleToLeadHistories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lead_histories', function (Blueprint $table) {
            $table->string('title')->nullable();
            $table->bigInteger('commentedby')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lead_histories', function (Blueprint $table) {
            $table->dropColumn('title');
            $table->dropColumn('commentedby');
        });
    }
}
