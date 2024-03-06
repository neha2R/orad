<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_payments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('lead_id')->default(0);
            $table->bigInteger('user_id')->default(0);
            $table->bigInteger('customer_id')->default(0);
            $table->boolean('payment_success')->default(0);
            $table->json('paytm_raw')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile')->nullable();
            $table->decimal('price', 10, 2)->default(0);
            $table->decimal('discounted_price', 10, 2)->default(0);
            $table->string('payment_link')->nullable();
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
        Schema::dropIfExists('course_payments');
    }
}
