<?php

namespace App\Http\Controllers;

use App\Buku;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Buku::all();
        return json_encode($data);
        // $datatables = datatables()->of($data)->addIndexColumn();
        // return $datatables->make(true);
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
            "isbn" => ["required"],
            "judul" => ["required"],
            "tahun" => ["required"],
            "id_penerbit" => ["required"],
            "id_pengarang" => ["required"],
            "id_katalog" => ["required"],
            "qty_stok" => ["required"],
            "harga_pinjam" => ["required"],
        ]);

        Buku::create($request->all());
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function show(Buku $buku)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function edit(Buku $buku)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Buku $buku)
    {
        $this->validate($request, [
            "isbn" => ["required"],
            "judul" => ["required"],
            "tahun" => ["required"],
            "id_penerbit" => ["required"],
            "id_pengarang" => ["required"],
            "id_katalog" => ["required"],
            "qty_stok" => ["required"],
            "harga_pinjam" => ["required"],
        ]);

        $buku->update($request->all());
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function destroy(Buku $buku)
    {
        $buku->delete();
        return back();
    }
}
