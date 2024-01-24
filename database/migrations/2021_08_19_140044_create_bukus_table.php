<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBukusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bukus', function (Blueprint $table) {
            $table->id();
            $table->integer("isbn");
            $table->string("judul", 64);
            $table->integer("tahun");
            $table->unsignedBigInteger("id_penerbit");
            $table->unsignedBigInteger("id_pengarang");
            $table->unsignedBigInteger("id_katalog");
            $table->integer("qty_stok");
            $table->integer("harga_pinjam");
            $table->timestamps();

            $table->foreign("id_penerbit")->references("id")->on("penerbits");
            $table->foreign("id_pengarang")->references("id")->on("pengarangs");
            $table->foreign("id_katalog")->references("id")->on("katalogs");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bukus');
    }
}
