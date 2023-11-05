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
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('user_id');
            $table->string('name',250);
            $table->string('nik',250)->nullable();
            $table->string('username',250)->unique();
            $table->string('photo_profile',250)->nullable();
            $table->text('address',)->nullable();
            $table->string('phone_number,30');
            $table->string('email',250)->unique();
           // $table->timestamp('email_verified_at')->nullable();
            $table->string('password',250);
           // $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });

        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
