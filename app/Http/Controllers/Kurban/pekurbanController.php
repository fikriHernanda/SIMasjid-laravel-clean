<?php

namespace App\Http\Controllers;
use App\pekurban;
use App\kurban;
use App\status_kurban;
use App\bagian_kurban;
use Auth;
use App\Anggota;
use Illuminate\Http\Request;
use PDF;

class pekurbanController extends Controller
{

    public function getDetail($id)
    {
        $pekurban = pekurban::get()->where('id', $id)->first();
        $pekurban->status = $pekurban->status_kurban->status;
        $pekurban->permintaan = $pekurban->bagian_kurban->bagian;
        $pekurban->jenis = $pekurban->kurban->jenis_kurban->jenis;
        $pekurban->kelas = $pekurban->kurban->kelas_kurban->kelas;
        $pekurban->tanggalPendaftaran = date('d-m-Y', strtotime($pekurban->created_at));
        $pekurban->hargaAktual = $pekurban->harga_aktual;

        
        return $pekurban;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $anggota = Auth::user();
        $pekurban = pekurban::whereNull('patungan_kurban')->get();
        $kurban = kurban::get();
        $bagian = bagian_kurban::orderBy('jenis_kurban_id', 'desc')->get();
        $data=[
            'anggota'  => $anggota,
            'kurban'=>$kurban,
            'bagian'=>$bagian,
            'list' =>$pekurban
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
        date_default_timezone_set('Asia/Jakarta');
        $date=date_create();
        // $paramHarga3 = str_replace('.', '', $paramHarga2);
        // $paramHarga4=trim($paramHarga3,"");
        $harga=$request->paramHarga;
        $kurbanPilihan = kurban::where('harga', $harga)->first();
        

      
        pekurban::create([
            'nama'=>$request->namaPekurban,
            'alamat'=>$request->alamat,
            'no_hp'=>$request->noHp,
            'kurban_id'=>$kurbanPilihan->id,
            'status_kurban_id'=> 1,
            'bagian_kurban_id'=>$request->bagianKurban,
            'created_at'=>$date
            

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
        date_default_timezone_set('Asia/Jakarta');
        $date=date_create();
        $request->validate([
            'namaPekurban' => 'required',
            'alamat' => 'required',
        ]);                                                                                                                                                                                                                                                         
        $harga=$request->jenis;
        $harga2 = str_replace(',', '', $harga);
      
       $hargaAktual =str_replace(',', '', $request->hargaAktual);
       
        $kurbanPilihan = kurban::where('harga', $harga2)->first();
            
        pekurban::where('id', $pekurban->id)
        ->update([
            'nama' => $request->namaPekurban,
            'alamat'=> $request->alamat,
            'no_hp'=>$request->noHp,
            'kurban_id'=>$kurbanPilihan->id,
            'status_kurban_id'=>$request->status,
            'harga_aktual'=>$hargaAktual,
            'updated_at'=> $date
            ]);
            $ispatungan = false;
        $pekurban = pekurban::find($pekurban->id);
        if($pekurban->patungan_kurban != 0){
            $ispatungan = true;
        }
        if($ispatungan == false){
            return redirect()->route('manajPekurban')->with('status', ' Data Pekurban  Berhasil Diubah');
        }else{
            return redirect()->route('manajUrunan')->with('status', ' Data Pekurban  Berhasil Diubah');
        }   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $ispatungan = false;
        $pekurban = pekurban::find($request->id);
        if($pekurban->patungan_kurban != 0){
            $ispatungan = true;
        }
        pekurban::destroy($request->id);
        if($ispatungan == false){
            return redirect()->route('manajPekurban')->with('status', 'Pekurban Kurban Berhasil Dihapus');
        }else{
            return redirect()->route('manajUrunan')->with('status', 'Pekurban Kurban Berhasil Dihapus');
        }   
            
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
     public function exportPDF($id){
        $pekurban = pekurban::where('id', $id)->first();
        if($pekurban->patungan_kurban != null ){
            $pekurban->patungan= 'true';
        }
        $pdf = PDF::loadView('kurban.exportpdf',['pekurban'=>$pekurban]);
        return $pdf->download('Bukti_pendaftaran_'.$pekurban->nama.'.pdf');
     }

    //  public function exportPDFPatungan($id){
    //     $pekurban = pekurban::where('id', $id)->first();
      
    //     $pdf = PDF::loadView('kurban.exportpdf',['pekurban'=>$pekurban]);
    //     return $pdf->download('Bukti_pendaftaran_'.$pekurban->nama.'.pdf');
    //  }

     public function lihatUrunan(){
        
        $pekurban_patungan = pekurban::whereNotNull('patungan_kurban')->get();
        $bagian = bagian_kurban::orderBy('jenis_kurban_id', 'desc')->get();
        $kurban = kurban::where('id','>', 3 )->get();
        $data=[
            'list' =>$pekurban_patungan,
            'bagian'=>$bagian,
            'kurban'=>$kurban
        ];
        return view('kurban/patunganPekurban')->with($data);
     }
     public function tambahUrunan(Request $request){
        
        date_default_timezone_set('Asia/Jakarta');
        $date=date_create();
        $harga=$request->paramHarga;
        $kurbanPilihan = kurban::where('harga', $harga)->first();
      
        $cek_jumlah = pekurban::where('patungan_kurban',1)->count();
        if($cek_jumlah==0){
            $cek_jumlah +=1;
        }elseif($cek_jumlah % 7 == 0){
            $cek_jumlah+=1;
        }
        $kloter = $cek_jumlah / 7 ;
        

        // $paramHarga3 = str_replace('.', '', $paramHarga2);
        // $paramHarga4=trim($paramHarga3,"");
        
        for ($i = 0; $i < count($request->namaPekurban); $i++) {
            $data[] = [
                'nama' =>$request->namaPekurban[$i],
                'alamat' => $request->alamat[$i],
                'no_hp' => $request->noHp[$i],
                'kurban_id'=>$kurbanPilihan->id,
                'status_kurban_id'=> 3,
                'created_at'=>$date,
                'bagian_kurban'=>$request->bagianKurban[i],
                'patungan_kurban'=>ceil($kloter)
            ];
        }
        pekurban::insert($data);


        // foreach($request as $requests ){
           
        // pekurban::create([
        //     'nama'=>$requests->namaPekurban[$loop],
        //     'alamat'=>$requests->alamat[$loop],
        //     'no_hp'=>$request->noHp[$loop],
        //     'kurban_id'=>$kurbanPilihan->id,
        //     'status_kurban_id'=> 3,
        //     // 'bagian_kurban_id'=>$request->bagianKurban,
        //     'created_at'=>$date,
        //     'patungan_kurban'=>ceil($kloter)

        // ]);
        
        // }
        return redirect('/pekurban/urunan');
        }
        
        public function getDetailPatungan($id)
        {
            $pekurban = pekurban::get()->where('id', $id)->first();
            $pekurban->status = $pekurban->status_kurban->status;
            $pekurban->permintaan = $pekurban->bagian_kurban->bagian;
            $pekurban->jenis = $pekurban->kurban->jenis_kurban->jenis;
            $pekurban->kelas = $pekurban->kurban->kelas_kurban->kelas;
            $pekurban->tanggalPendaftaran = date('d-m-Y', strtotime($pekurban->created_at));
    
        
            return $pekurban;
        }
}
