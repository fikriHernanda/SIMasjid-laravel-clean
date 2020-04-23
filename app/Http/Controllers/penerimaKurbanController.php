<?php

namespace App\Http\Controllers;
use App\penerima_kurban;
use Illuminate\Http\Request;

class penerimaKurbanController extends Controller
{

    public function getDetail($id){
        $penerima = penerima_kurban::get()->where('id', $id)->first();
        $penerima->tanggalPendaftaran = date('d-m-Y', strtotime($penerima->created_at));
       
        
        return $penerima;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     
        $penerima = penerima_kurban::get();
        $data=[
           'list'=>$penerima
        ];
        return view('kurban/penerimaKurban')->with($data);
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
        date_default_timezone_set('Asia/Jakarta');
        $date=date_create();
        // $paramHarga3 = str_replace('.', '', $paramHarga2);
        // $paramHarga4=trim($paramHarga3,"");

        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
        ]);   
        penerima_kurban::create([
            'nama'=>$request->nama,
            'alamat'=>$request->alamat,
            'no_hp'=>$request->noHp,
            'jenis'=> $request->jenis,
            'keterangan'=>$request->keterangan,
            'status'=> "terdaftar",
            'created_at'=>$date
            

        ]);
        return redirect()->route('manajPenerimaKurban');
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
    public function edit($id)
    {
        $penerima = penerima_kurban::find($id);
        $data=[
            'penerima'=> $penerima,
        ];
        return view('kurban/editPenerimaKurban')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        date_default_timezone_set('Asia/Jakarta');
        $date=date_create();
        $nohp2 = str_replace(' ', '', $request->noHp);

        penerima_kurban::where('id', $id)
        ->update([
            'nama' => $request->nama,
            'alamat'=>$request->alamat,
            'no_hp'=>$nohp2,
            'jenis'=> $request->jenis,
            'keterangan'=>$request->keterangan,
            'status'=> $request->status,
            'updated_at'=>$date
            ]);
            return redirect()->route('manajPenerimaKurban')->with('status', 'Penerima Kurban Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)    {
        penerima_kurban::destroy($request->id);
            return redirect()->route('manajPekurban')->with('status', 'Penerima Kurban Berhasil Dihapus');
    }
}
