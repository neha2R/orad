<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentComplaintsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_complaints', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('content_id')->nullable();
            $table->bigInteger('complaint_creator')->nullable();
            $table->bigInteger('assigned_to')->nullable();
            $table->boolean('senior_proofread')->default(0);
            $table->boolean('junior_proofread')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('content_complaints');
    }
}
