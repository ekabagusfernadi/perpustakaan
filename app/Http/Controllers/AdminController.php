<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Anggota;
use App\Buku;
use App\Penerbit;
use App\Pengarang;
use App\Katalog;
use App\Peminjaman;
use DB;

class AdminController extends Controller
{
    public function dashboard()
    {   
        $total_buku = Buku::count(); 
        $total_anggota = Anggota::count();
        $total_penerbit = Penerbit::count();
        $total_peminjaman = Peminjaman::whereMonth("tgl_pinjam", date("m"))->count();

        // GRAFIK DONUT
        $data_donut = Buku::select(DB::raw("COUNT(id_penerbit) as total"))->groupBy("id_penerbit")->orderBy("id_penerbit", "asc")->pluck("total");
        // $label_donut = Penerbit::orderBy("penerbits.id", "asc")->join("bukus", "bukus.id_penerbit", "=", "penerbits.id")->groupBy("nama_penerbit")->pluck("nama_penerbit");
        $label_donut = Penerbit::join("bukus", "bukus.id_penerbit", "=", "penerbits.id")->groupBy("nama_penerbit")->pluck("nama_penerbit");

        // var_dump($data_donut); die;
        // return $data_donut;
        // return $label_donut;

        // GRAFIK BAR
        $label_bar = ["Peminjaman", "Pengembalian"];
        $data_bar = [];
        foreach( $label_bar as $key => $value ) {
            $data_bar[$key]["label"] = $label_bar[$key];
            $data_bar[$key]["backgroundColor"] = $key == 0 ? "rgba(60,141,188,0.9)" : "rgba(210, 214, 222, 1)";
            $data_month = [];

            foreach( range(1,12) as $month ) {
                if( $key == 0) {
                    $data_month[] = Peminjaman::select(DB::raw("COUNT(*) as total"))->whereMonth("tgl_pinjam", $month)->first()->total;
                } else {
                    $data_month[] = Peminjaman::select(DB::raw("COUNT(*) as total"))->whereMonth("tgl_kembali", $month)->first()->total;
                }
            }
            $data_bar[$key]["data"] = $data_month;
        }
        // return $data_bar;

        // GRAFIK PIE
        $data_pie = Buku::select(DB::raw("COUNT(id_katalog) as total"))->groupBy("id_katalog")->orderBy("id_katalog", "asc")->pluck("total");
        $label_pie = Katalog::join("bukus", "bukus.id_katalog", "=", "katalogs.id")->groupBy("nama")->pluck("nama");
        // return $label_pie;
        return view("admin.dashboard", compact("total_buku", "total_anggota", "total_penerbit", "total_peminjaman", "data_donut", "label_donut", "data_bar", "data_pie", "label_pie"));
    }

    public function buku()
    {
        return view("admin.buku.buku");
    }

    public function katalog()
    {
        return view("admin.katalog.katalog");
    }

    public function penerbit()
    {
        return view("admin.penerbit.penerbit");
    }

    public function pengarang()
    {
        // $data_pengarang = Pengarang::all();
        // return view("admin.pengarang.pengarang", compact("data_pengarang"));
        return view("admin.pengarang.pengarang");
    }

    public function anggota()
    {
        return view("admin.anggota.anggota");
    }

    public function peminjaman()
    {
        return Peminjaman::with("anggota", "detail_peminjaman", "buku", "list_buku")->get();
        // $tes = Peminjaman::with("anggota", "detail_peminjaman", "buku")->get();
        // return $tes[0]->buku[0]->harga_pinjam;
        // $tes = Peminjaman::orderBy('id', 'desc')->limit(1)->get();
        // return $tes[0]->id;
        // $getBuku = Buku::where('id', '=', 4)->get();
        // return $getBuku[0]->id;
        // $getBuku = Buku::find(4);
        // return $getBuku->qty_stok;

        $anggota = Anggota::all();
        $buku = Buku::where('qty_stok', '>', 0)->get();
        return view("admin.peminjaman.peminjaman", compact("anggota", "buku"));
    }

    // public function detail_peminjaman()
    // {
    //     return view("admin.detail_peminjaman.detail_peminjaman");
    // }
    
}
