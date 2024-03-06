<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leaves', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('leave_type')->comment="paid or unpaid";
            $table->string('leave_for')->comment="part time or full time";
            $table->longText('reason')->comment="leave reason";
            $table->date('from');
            $table->date('to');
            $table->enum('status',['0','1','2'])->comment="0=pending, 1=approved, 2=reject";
            $table->foreignId('approved_by')->nullable();
            $table->longText('approval_reason')->nullable()->comment="leave reason";
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
        Schema::dropIfExists('leaves');
    }
}
