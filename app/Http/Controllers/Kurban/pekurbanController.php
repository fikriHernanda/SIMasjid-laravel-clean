<?php

namespace App\Http\Controllers;
use App\pekurban;
use App\kurban;
use App\status_kurban;
use App\Anggota_Jabatan;
use App\Anggota_Status;
use Auth;
use App\Anggota;
use Illuminate\Http\Request;

class pekurbanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $anggota = Auth::user();
        $pekurban = pekurban::get();
        $kurban = kurban::get();
        $data=[
            'anggota'  => $anggota,
            'kurban'=>$kurban,
            'list' =>$pekurban,
        ];
        return view('kurban/pekurban')->with($data);

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
        $harga=$request->paramHarga;
        
        // $paramHarga2 = str_replace(',', '', $harga);
        // $paramHarga3 = str_replace('.', '', $paramHarga2);
        // $paramHarga4=trim($paramHarga3,"");
        $kurbanPilihan = kurban::where('harga', $harga)->first();
       
        pekurban::create([
            'nama'=>$request->namaPekurban,
            'alamat'=>$request->alamat,
            'no_hp'=>$request->noHp,
            'kurban_id'=>$kurbanPilihan->id,
            'status_kurban_id'=> 1,
            

        ]);
        return redirect()->route('manajPekurban');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(pekurban $pekurban)
    {
       
        $pekurban = pekurban::find($pekurban->id);
        $kurban = kurban::get();
        $status_kurban= status_kurban::get();
        $data=[
            'pekurban'=> $pekurban,
            'kurbans'=>$kurban,
            'status_kurban'=>$status_kurban
        ];
        return view('kurban/editPekurban')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, pekurban $pekurban)
    {
                                                                                                                                                                                                                                                                                     
        $harga=$request->paramHarga;
        $kurbanPilihan = kurban::where('harga', $harga)->first();
        pekurban::where('id', $pekurban->id)
        ->update([
            'nama' => $request->namaPekurban,
            'alamat'=> $request->alamat,
            'no_hp'=>$request->noHp,
            'kurban_id'=>$kurbanPilihan->id,
            'status_kurban_id'=>$request->status
            ]);
            return redirect()->route('manajPekurban');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function progress()
    {
        $anggota = Auth::user();
        $anggota->status = Anggota_Status::find($anggota->id_status)->status;
        $anggota->jabatan = Anggota_Jabatan::find($anggota->id_jabatan)->jabatan;
        $data=[
            'anggota'  => $anggota,
            
        ];
        return view('kurban/progress')->with($data);
    }
}
