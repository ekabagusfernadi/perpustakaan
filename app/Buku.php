<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $fillable = [
        "isbn",
        "judul",
        "tahun",
        "id_penerbit",
        "id_pengarang",
        "id_katalog",
        "qty_stok",
        "harga_pinjam"
    ];

    // public function penerbit()
    // {
    //     return $this->belongsTo("App\Penerbit", "id_penerbit");
    // }

    // public function pengarang()
    // {
    //     return $this->belongsTo("App\Pengarang", "id_pengarang");
    // }

    // public function katalog()
    // {
    //     return $this->belongsTo("App\Katalog", "id_katalog");
    // }

    public function detail_peminjaman()
    {
        return $this->hasMany("App\DetailPeminjaman", "id");
    }
}
