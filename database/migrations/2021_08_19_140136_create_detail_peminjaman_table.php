<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPeminjamanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_peminjaman', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("id_peminjaman");
            $table->unsignedBigInteger("id_buku");
            $table->integer("qty");
            $table->timestamps();

            $table->foreign("id_peminjaman")->references("id")->on("peminjaman");
            $table->foreign("id_buku")->references("id")->on("bukus");
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_peminjaman');
    }
}
