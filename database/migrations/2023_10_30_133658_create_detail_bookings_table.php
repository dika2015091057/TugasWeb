<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('detail_bookings', function (Blueprint $table) {
            $table->bigIncrements('detail_booking_id');
            $table->bigInteger('vehicle_id')->unsigned();
            $table->bigInteger('booking_id')->unsigned();
            $table->bigInteger('qty');
            $table->double('price_total_charter',12 ,2)->default(0);
            $table->date('pickup_date')->nullable();
            $table->date('return_date')->nullable();
            $table->integer('day')->default(0);
            $table->string('status')->default("belum dibayar");
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('vehicle_id')->references('vehicle_id')->on('vehicles');
            $table->foreign('booking_id')->references('booking_id')->on('bookings');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_bookings');
    }
};
