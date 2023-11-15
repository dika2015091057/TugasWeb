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
        Schema::create('admins', function (Blueprint $table) {
            $table->bigIncrements('admin_id');
            $table->bigInteger('role_id')->unsigned();
            $table->string('email')->unique();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('owner')->nullable();
            $table->text('address')->nullable();
            $table->string('photo_profile')->nullable();
            $table->string('phone_number')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('role_id')->references('role_id')->on('roles');
        });

        // Schema::table('admins',function(Blueprint $table){
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
