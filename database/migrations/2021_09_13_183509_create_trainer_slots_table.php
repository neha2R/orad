<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainerSlotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainer_slots', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->foreignId('manager_id')->nullable();
            $table->foreignId('trainer_id');
            $table->foreignId('slot_id');
            $table->foreignId('lead_id')->nullable();
            $table->enum('is_active',['0','1'])->default('1')->comment="1=active, 0=inactive";
            $table->enum('type',['0','1','2'])->default('0')->comment="class type 0=demo 1=personal 2= group";
            $table->integer('available_seats')->default('1')->comment="no of seats for group class";
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
        Schema::dropIfExists('trainer_slots');
    }
}
