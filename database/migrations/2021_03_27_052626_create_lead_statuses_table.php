<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lead_statuses', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('leadid');
            $table->bigInteger('assignedby')->default(0);
            $table->bigInteger('assignedto')->default(0);
            $table->tinyInteger('level')->default(2);
            $table->tinyInteger('leadtype')->default(1);
            $table->bigInteger('department')->default(3);
            $table->longText('comments')->nullable();
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
        Schema::dropIfExists('lead_statuses');
    }
}
