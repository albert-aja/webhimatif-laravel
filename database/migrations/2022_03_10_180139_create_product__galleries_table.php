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
        Schema::create('product__galleries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shop__items_id')->comment('ID Item')
                    ->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->string('photo')->comment('Foto Item');
            $table->integer('photo_order')->comment('Urutan Foto');
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
        Schema::dropIfExists('product__galleries');
    }
};
