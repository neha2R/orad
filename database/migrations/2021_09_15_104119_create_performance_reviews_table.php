<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerformanceReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('performance_reviews', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('agenda')->commnet="agenda of meeting";
            $table->foreignId('created_by')->comment="creator id";
            $table->enum('is_active',['0','1'])->default(1);
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
        Schema::dropIfExists('performance_reviews');
    }
}
