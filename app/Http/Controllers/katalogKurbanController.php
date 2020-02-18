<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\kurban;
use Auth;
use App\Models\Anggota\Anggota;


class katalogKurbanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
       

        $katalogKurban = kurban::get();
        $data=[
           
            'list' =>$katalogKurban
        ];
      
        return view('kurban/katalogKurban')->with($data);
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
        $harga=$request->harga;                                                      
        $satuanBerat = $request->satuan;
        if($satuanBerat==1){
            $hasil= $request->berat/1000;
        }else{
            $hasil = $request->berat;
        }                                                                                                                  
       
       $harga2 = str_replace(',', '', $harga);
       
        kurban::create([
            'jenis_kurban_id'=>$request->jenis,
            'kelas_kurban_id'=>$request->kategori,
            'harga'=>$harga2,
            'keterangan'=>$request->keterangan,
            'berat'=>$hasil

        ]);
        
        return redirect()->route('manajKurban');
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
    public function getDetail($id)
    {
        $kurban = kurban::get()->where('id', $id)->first();
        $kurban->jenis = $kurban->jenis_kurban->jenis;
        $kurban->kelas = $kurban->kelas_kurban->kelas;
        return $kurban;

        
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(kurban $kurban)
    {
        $anggota = Auth::user();
        $kurban = kurban::find($kurban->id);
        $data=[
            'kurban'=> $kurban,
            'anggota'  => $anggota
        ];
        return view('kurban/editKatalogKurban')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, kurban $kurban)
    {
        $harga=$request->harga;                                                      
        $satuanBerat = $request->satuan;
        if($satuanBerat==1){
            $hasil= $request->berat/1000;
        }else{
            $hasil = $request->berat;
        }                                                                                                                                                                                                                                                                                                                        
        $harga2 = str_replace(',', '', $harga);
        kurban::where('id', $kurban->id)
        ->update([
            'harga' => $harga2,
            'keterangan'=> $request->keterangan,
            'berat'=>$hasil
            ]);
            return redirect()->route('manajKurban');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(kurban $kurban)
    {
        kurban::destroy($kurban->id);
        return redirect()->route('manajKurban')->with('status', 'Hewan Kurban Berhasil Dihapus');
    }
}
