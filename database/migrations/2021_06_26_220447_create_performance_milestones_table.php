<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerformanceMilestonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('performance_milestones', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('department')->default(0);
            $table->smallInteger('role')->default(0);
            $table->bigInteger('from')->default(0);
            $table->bigInteger('to')->default(0);
            $table->float('incentivepercentage', 8, 2);
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
        Schema::dropIfExists('performance_milestones');
    }
}
