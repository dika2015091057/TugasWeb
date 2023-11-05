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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->bigIncrements('vehicle_id');
            $table->bigInteger('admin_id')->unsigned();
            $table->string('name');
            $table->bigInteger('stock');
            $table->string('type');
            $table->double('charter_price', 12, 2);
            $table->string('status')->nullable();
            $table->text('description');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('admin_id')->references('admin_id')->on('admins');
        });

        // Schema::table('vehicles',function(Blueprint $table){
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
