<?php

namespace App\Http\Controllers;
use App\penyembelih;

use Illuminate\Http\Request;

class penyembelihController extends Controller
{


    public function getDetail($id){
        $penyembelih = penyembelih::get()->where('id', $id)->first();
        $penyembelih->tanggalterdaftar= date('d-m-Y', strtotime($penyembelih->created_at));
       
        
        return $penyembelih;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     $penyembelih = penyembelih::get();
        $data=[
         'list'=>$penyembelih
        ];
        return view('kurban/penyembelih')->with($data);
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
        penyembelih::create([
            'nama'=>$request->nama,
            'alamat'=>$request->alamat,
            'telp'=>$request->noHp,
            'posisi'=>$request->posisi,
            'created_at'=>$date
            

        ]);
        return redirect()->route('manajPenyembelih');
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
        $penyembelih = penyembelih::find($id);
        $data=[
            'penyembelih'=> $penyembelih,
        ];
        return view('kurban/editPenyembelih')->with($data);
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

        penyembelih::where('id', $id)
        ->update([
            'nama' => $request->nama,
            'alamat'=>$request->alamat,
            'telp'=>$nohp2,
            'posisi'=>$request->posisi,
            'updated_at'=>$date
            ]);
            return redirect()->route('manajPenyembelih')->with('status', 'Data Penyembelih Kurban Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        penyembelih::destroy($request->id);
     
        return redirect()->route('manajPenyembelih')->with('status', 'Tenaga Penyembelih Kurban Berhasil Dihapus');
    }
}
