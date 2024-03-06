<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMigrationToOradContents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orad_contents', function (Blueprint $table) {
            $table->longText('contentexplaination')->nullable();
            $table->bigInteger('assignedby')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orad_contents', function (Blueprint $table) {
            $table->dropColumn('contentexplaination');
            $table->dropColumn('assignedby');
        });
    }
}
