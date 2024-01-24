<?php

namespace App\Http\Controllers;

use App\Anggota;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if( $request->sex ) {
            $datas = Anggota::where('sex', $request->sex)->get();
        } else {
            $datas = Anggota::all();
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
        $this->validate($request, [
            "nama" => ["required"],
            "sex" => ["required"],
            "telp" => ["required", "numeric"],
            "alamat" => ["required"],
            "email" => ["required", "email"]
        ]);

        Anggota::create($request->all());

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Anggota  $anggota
     * @return \Illuminate\Http\Response
     */
    public function show(Anggota $anggota)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Anggota  $anggota
     * @return \Illuminate\Http\Response
     */
    public function edit(Anggota $anggota)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Anggota  $anggota
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, Anggota $anggota)
    public function update(Request $request, Anggota $anggota, $id)
    {
        $this->validate($request, [
            "nama" => ["required"],
            "sex" => ["required"],
            "telp" => ["required", "numeric"],
            "alamat" => ["required"],
            "email" => ["required", "email"]
        ]);

        // $anggota = Anggota::where("id", $anggota)->first();
        $anggota = Anggota::find($id);
        $anggota->update($request->all());

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Anggota  $anggota
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Anggota $anggota)
    public function destroy( Anggota $anggota, $id)
    {
        // $anggota = Anggota::where("id", $anggota)->first();
        $anggota = Anggota::find($id);
        $anggota->delete();
        return back();
    }
}
