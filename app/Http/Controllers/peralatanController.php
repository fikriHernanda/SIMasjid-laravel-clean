<?php

namespace App\Http\Controllers;
use App\peralatan;
use Illuminate\Http\Request;

class peralatanController extends Controller
{

      //CONSTANT VALUES FOR TOOLS STATUS
      public const BELUM_TERSEDIA = 1;
      public const DISIMPAN = 2;
      //CONSTANT VALUES FOR DENOMINATION
      public const UNIT = 1;
      public const LEMBAR = 2;
      public const PAK = 3;
      public const SET = 4;


      public function getDetail($id){
        $peralatan = peralatan::get()->where('id', $id)->first();
        $peralatan->tanggalPendaftaran = date('d-m-Y', strtotime($peralatan->created_at));
        $peralatan->terakhirDiubah = date('d-m-Y', strtotime($peralatan->updated_at));
        $peralatan->status =  $this->getStatus($peralatan);
        $peralatan->satuan =  $this->getSatuan($peralatan); 
        return $peralatan;
    }
      public static function getStatus(Peralatan $peralatan)
    {
        switch ($peralatan->id_status) {
            case (self::BELUM_TERSEDIA):
                return 'Belum Tersedia';
                break;
            case (self::DISIMPAN):
                return 'Disimpan';
                break;
            default:
                return 'Peralatan';
                break;
        }
    }
    public static function getSatuan(Peralatan $peralatan)
    {
        switch ($peralatan->id_satuan) {
            case (self::UNIT):
                return 'Unit';
                break;
            case (self::LEMBAR):
                return 'Dikerjakan';
                break;
            case (self::PAK):
                return 'Pak';
                break;
            case (self::SET):
                return 'Set';
                break;    
            default:
                return 'Pekerjaan';
                break;
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $peralatanGroup = peralatan::get(); 
        foreach ($peralatanGroup as $peralatan) {
            $peralatan->status =  $this->getStatus($peralatan);
            $peralatan->satuan =  $this->getSatuan($peralatan);
        } 
    
        $data=[
            'list'=>$peralatanGroup
        ];
        return view('kurban/peralatan')->with($data);
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
            'namaperalatan' => 'required',
            'jumlah' => 'required',
        ]);   
        peralatan::create([
            'nama'=>$request->namaperalatan,
            'jumlah'=>$request->jumlah,
            'id_satuan'=>$request->satuan,
            'keterangan'=>$request->keterangan,
            'id_status'=> "1",
            'harga'=>;
            'created_at'=>$date
        ]);
        return redirect()->route('manajPeralatan');
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
        $peralatan = peralatan::find($id);
        $data=[
            'peralatan'=> $peralatan,
        ];
        return view('kurban/editPeralatan')->with($data);
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
        peralatan::where('id', $id)
        ->update([
            'nama'=>$request->namaperalatan,
            'jumlah'=>$request->jumlah,
            'id_satuan'=>$request->satuan,
            'keterangan'=>$request->keterangan,
            'id_status'=> "$request->status",
            'updated_at'=>$date
            ]);
            return redirect()->route('manajPeralatan')->with('status', 'Data Peralatan Kegiatan Kurban Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        peralatan::destroy($request->id);
        return redirect()->route('manajPeralatan')->with('status', 'Data Peralatan Kurban Berhasil Dihapus');
    }
}
