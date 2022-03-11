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
        Schema::create('work__programs', function (Blueprint $table) {
            $table->id();
            $table->string('program')->comment('Program Kerja');
            $table->text('description')->comment('Deskripsi Progja');
            $table->foreignId('division_id')->comment('Divisi Terkait')
                    ->constrained()->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('work__programs');
    }
};
