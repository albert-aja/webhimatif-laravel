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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('Judul Berita');
            $table->string('slug')->comment('Slug Berita');
            $table->string('hero_image')->comment('Gambar Utama Berita');
            $table->text('article')->comment('Artikel Berita');
            $table->foreignId('division_id')->nullable()->comment('Divisi Terkait')
                    ->constrained()->nullOnDelete()->onUpdate('cascade');
            $table->string('viewed')->comment('Jumlah Pembaca');
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
        Schema::dropIfExists('posts');
    }
};
