<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = "peminjaman";
    protected $guarded = [
        "id"
    ];

    public function buku()
    {
        return $this->belongsToMany("App\Buku", "detail_peminjaman", "id_peminjaman", "id_buku");
    }

    public function anggota()
    {
        return $this->belongsTo("App\Anggota", "id_anggota");
    }

    public function detail_peminjaman()
    {
        return $this->hasMany("App\DetailPeminjaman", "id_peminjaman");
    }

    public function list_buku()
    {
        return $this->hasOne("App\Buku", "id");
    }
}
