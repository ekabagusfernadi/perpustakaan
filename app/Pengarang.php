<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengarang extends Model
{
    protected $fillable = [
        "nama_pengarang",
        "email",
        "telp",
        "alamat"
    ];

    public function buku()
    {
        return $this->hasMany("App\Buku", "id_pengarang");
    }
}
