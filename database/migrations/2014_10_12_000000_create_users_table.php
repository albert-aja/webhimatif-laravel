<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('username');
            $table->string('password');
            $table->string('activation_hash')->nullable();
            $table->timestamp('activation_expires')->nullable();
            $table->boolean('activation_status')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('reset_hash')->nullable();
            $table->timestamp('reset_at')->nullable();
            $table->timestamp('reset_expires')->nullable();
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
        Schema::dropIfExists('users');
    }
};
