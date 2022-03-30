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
        Schema::create('product__with__colors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shop__items_id')->nullable()->comment('ID Item')
                    ->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('product__colors_id')->nullable()->comment('ID Warna')
                    ->constrained()->nullOnDelete()->onUpdate('cascade');
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
        Schema::dropIfExists('product__with__colors');
    }
};
