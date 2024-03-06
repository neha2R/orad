<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePRJoineesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_r_joinees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('performance_reviews_id')->constrained()->comment="performance_reviews id";
            $table->foreignId('department')->comment="employee department";
            $table->foreignId('sub_department')->comment="employee sub department";
            $table->foreignId('employee_id')->nullable();
            $table->longText('join_link');
            $table->enum('rating',['0','1','2','3','4','5'])->default(0);
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
        Schema::dropIfExists('p_r_joinees');
    }
}
