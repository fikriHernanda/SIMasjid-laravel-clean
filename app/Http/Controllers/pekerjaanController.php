<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\panitia;
use App\pekerjaan;
class pekerjaanController extends Controller
{
     //CONSTANT VALUES FOR ACITIVITY STATUS
     public const DALAM_DAFTAR = 1;
     public const DIKERJAKAN = 2;
     public const SELESAI_DIKERJAKAN= 3;
     
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getDetail($id){
        $pekerjaan = pekerjaan::get()->where('id', $id)->first();
        $pekerjaan->status =  $this->getStatus($pekerjaan);
        $pekerjaan->tanggalDiantrikan = date('d-m-Y', strtotime($pekerjaan->created_at));
        $pekerjaan->penanggungJawab = $pekerjaan->panitia->anggota->nama;
       
        
        return $pekerjaan;
    }
    public static function getStatus(Pekerjaan $pekerjaan)
    {
        switch ($pekerjaan->id_status) {
            case (self::DALAM_DAFTAR):
                return 'Dalam Daftar';
                break;
            case (self::DIKERJAKAN):
                return 'Dikerjakan';
                break;
            case (self::SELESAI_DIKERJAKAN):
                return 'Selesai Dikerjakan';
                break;
            default:
                return 'Pekerjaan';
                break;
        }
    }
    public function index()
    {

       $panitia= panitia::get();
       $pekerjaanGroup = pekerjaan::get(); 
       foreach ($pekerjaanGroup as $pekerjaan) {
        $pekerjaan->status =  $this->getStatus($pekerjaan);
        } 
       
       $data=[
            'panitia'=>$panitia,
            'list'=>$pekerjaanGroup

        ];
        return view('kurban/pekerjaan')->with($data);
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
            'namaaktivitas' => 'required',
            'penanggungjawab' => 'required',
            'keterangan'=> 'required'
        ]);   
        pekerjaan::create([
            'nama_aktivitas'=>$request->namaaktivitas,
            'panitia_id'=>$request->penanggungjawab,
            'status'=>1,
            'keterangan'=>$request->keterangan,
            'created_at'=>$date
            

        ]);
        return redirect()->route('manajPekerjaan')->with('status', 'Data Pekerjaan Persiapan Kurban Berhasil Ditambahkan');
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
        $pekerjaan = pekerjaan::find($id);
        $panitia = panitia::get();
        $data=[
            'pekerjaan'=> $pekerjaan,
            'panitia'=>$panitia
        ];
        return view('kurban/editPekerjaan')->with($data);
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

        $request->validate([
            'namaaktivitas' => 'required',
            'penanggungjawab' => 'required',
            'keterangan'=> 'required',
            'status'=>'required'
        ]);   

        date_default_timezone_set('Asia/Jakarta');
        $date=date_create();
        pekerjaan::where('id', $id)
        ->update([
            'nama_aktivitas' => $request->namaaktivitas,
            'panitia_id'=>$request->penanggungjawab,
            'keterangan'=>$request->keterangan,
            'id_status'=> $request->status,
            'updated_at'=>$date
            ]);
            return redirect()->route('manajPekerjaan')->with('status', 'Pekerjaan Persiapan Kurban Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        pekerjaan::destroy($request->id);
        return redirect()->route('manajPekerjaan')->with('status', 'Pekerjaan Persiapan Kurban Berhasil Dihapus');
    }
}
