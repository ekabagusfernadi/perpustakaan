<?php

namespace App\Http\Controllers;

use App\DetailPeminjaman;
use App\Peminjaman;
use App\Buku;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // if( $request->status ) {
        //     if( $request->status == "sudah" ) {
        //         $datas = Peminjaman::with("anggota", "detail_peminjaman", "buku")->where("peminjaman.status", true)->get();
        //     } else {
        //         $datas = Peminjaman::with("anggota", "detail_peminjaman", "buku")->where("peminjaman.status", false)->get();
        //     }
        // } else {
        //     $datas = Peminjaman::with("anggota", "detail_peminjaman", "buku")->get();
        // }
        $where = "";
        if( $request->status == "sudah" ) {
            $where .= " and peminjaman.status = true";
        } else if( $request->status == "belum" ) {
            $where .= " and peminjaman.status = false";
        }

        if( $request->datepicker ) {
            // $tanggal = date("Y-m-d", strtotime($request->datepicker));
            $where .= " and peminjaman.tgl_pinjam = '$request->datepicker'";
        }
        
        $datas = Peminjaman::with("anggota", "detail_peminjaman", "buku", "list_buku")->whereRaw("1=1$where")->get();
        // $datas = Peminjaman::with("anggota", "detail_peminjaman", "buku")->whereRaw("1=1 and peminjaman.status = true and peminjaman.tgl_pinjam = '2021-08-12'")->get();

        $datatables = datatables()->of($datas)->addIndexColumn();

        return $datatables->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            "id_anggota" => ["required"],
            "tgl_pinjam" => ["required"],
            "tgl_kembali" => ["required"],
            "id_buku" => ["required"]
        ]);
        
        // $requestPeminjaman = [
        //     "id_anggota" => $request["id_anggota"],
        //     "tgl_pinjam" => $request["tgl_pinjam"],
        //     "tgl_kembali" => $request["tgl_kembali"]
        // ];

        // $idPeminjaman = Peminjaman::orderBy('id', 'desc')->limit(1)->get();
        // $requestDetailPeminjaman = [
        //     "id_peminjaman" => $idPeminjaman["id"],
        //     "id_buku" => $request["id_buku"],
        //     "qty" => 1
        // ];

        // return $request->id_buku;


        
        // Peminjaman::create($request->all());
        $peminjaman = new Peminjaman;
        $peminjaman->id_anggota = $request->id_anggota;
        $peminjaman->tgl_pinjam = $request->tgl_pinjam;
        $peminjaman->tgl_kembali = $request->tgl_kembali;
        $peminjaman->save();

        $bukus = $request->id_buku;
        foreach( $bukus as $key => $value ) {
            // DetailPeminjaman::create($requestDetailPeminjaman->all());
            $idPeminjaman = Peminjaman::orderBy('id', 'desc')->limit(1)->get();
            $detailPeminjaman = new DetailPeminjaman;
            $detailPeminjaman->id_peminjaman = $idPeminjaman[0]->id;
            $detailPeminjaman->id_buku = $value;
            $detailPeminjaman->qty = 1;
            $detailPeminjaman->save();

            // BUKU qty
            $getBuku = Buku::find($value);
            $qtyBuku = $getBuku->qty_stok;
            $getBuku->update(['qty_stok' => $qtyBuku - 1]);
            // Buku::where('id', $request->id_buku)->update(['qty' => $qtyBuku - 1]);
        }

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */
    public function show(Peminjaman $peminjaman)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */
    public function edit(Peminjaman $peminjaman)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Peminjaman $peminjaman)
    {
        $this->validate($request, [
            "id_anggota" => ["required"],
            "tgl_pinjam" => ["required"],
            "tgl_kembali" => ["required"],
            "id_buku" => ["required"]
        ]);
        $peminjaman->update($request->all());
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */
    public function destroy(Peminjaman $peminjaman)
    {
        $idPeminjaman = $peminjaman->id;
        $peminjamanNich = DetailPeminjaman::where('id_peminjaman', $idPeminjaman)->get();
        foreach( $peminjamanNich as $pinjam ) {
            $getBuku = Buku::find($pinjam->id_buku);
            $qtyBuku = $getBuku->qty_stok;
            $getBuku->update(['qty_stok' => $qtyBuku + 1]);
            $pinjam->delete();
        }
        // return $peminjaman[0]->id_buku;
        $peminjaman->delete();
        return back();
    }
}
