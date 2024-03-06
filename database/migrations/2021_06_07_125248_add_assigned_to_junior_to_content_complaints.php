<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAssignedToJuniorToContentComplaints extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('content_complaints', function (Blueprint $table) {
            $table->bigInteger('assigned_to_junior')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('junior_to_content_complaints', function (Blueprint $table) {
            $table->dropColumn('assigned_to_junior');
        });
    }
}
