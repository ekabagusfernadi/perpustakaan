<?php

namespace App\Http\Controllers;

use App\DetailPeminjaman;
use Illuminate\Http\Request;

class DetailPeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if( $request->status ) {
            $datas = DetailPeminjaman::where('status', $request->status)->get();
        } else {
            // $datas = DetailPeminjaman::all();
            $datas = DetailPeminjaman::with("buku")->get();
        }

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DetailPeminjaman  $detailPeminjaman
     * @return \Illuminate\Http\Response
     */
    public function show(DetailPeminjaman $detailPeminjaman)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DetailPeminjaman  $detailPeminjaman
     * @return \Illuminate\Http\Response
     */
    public function edit(DetailPeminjaman $detailPeminjaman)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DetailPeminjaman  $detailPeminjaman
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DetailPeminjaman $detailPeminjaman)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DetailPeminjaman  $detailPeminjaman
     * @return \Illuminate\Http\Response
     */
    public function destroy(DetailPeminjaman $detailPeminjaman)
    {
        //
    }
}
