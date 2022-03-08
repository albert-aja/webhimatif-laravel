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
        Schema::create('commitees', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Nama Pengurus');
            $table->string('photo')->comment('Foto Pengurus');
            $table->foreignId('position_id')->nullable()->comment('Jabatan Pengurus')
                    ->constrained()->nullOnDelete()->onUpdate('cascade');
            $table->foreignId('division_id')->comment('Divisi Pengurus')
                    ->constrained()->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commitees');
    }
};
