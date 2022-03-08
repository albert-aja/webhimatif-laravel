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
        Schema::create('shop__items', function (Blueprint $table) {
            $table->id();
            $table->string('item')->comment('Nama Item');
            $table->string('slug')->comment('Slug Item');
            $table->string('photos')->comment('Foto Item');
            $table->text('description')->comment('Deskripsi Item');
            $table->foreignId('product__categories_id')->nullable()->comment('Kategori Item')
                    ->constrained()->nullOnDelete()->onUpdate('cascade');
            $table->string('product_color')->nullable()->comment('Warna Item (Optional) (Untuk Baju)');
            $table->string('price')->comment('Harga Item');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shop__items');
    }
};
