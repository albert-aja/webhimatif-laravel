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
        Schema::create('social__media', function (Blueprint $table) {
            $table->id();
            $table->string('social')->comment('Media Sosial');
            $table->string('link')->comment('Link Media Sosial');
            $table->string('icon')->comment('Ikon Media Sosial');
            $table->string('color')->comment('Warna background Media Sosial');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('social__media');
    }
};
