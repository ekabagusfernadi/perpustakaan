<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailPeminjaman extends Model
{
    protected $guarded = [
        "id"
    ];
    protected $table = "detail_peminjaman";

    public function buku()
    {
        return $this->belongsTo("App\Buku", "id_buku");
    }

    public function anggota()
    {
        return $this->belongsTo("App\Anggota", "id_anggota");
    }

    public function peminjaman()
    {
        return $this->belongsTo("App\Peminjaman", "id");
    }
}
