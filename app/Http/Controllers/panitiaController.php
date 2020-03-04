<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anggota\Anggota;
use App\panitia;
use Auth;
use App\Http\Controllers\Controller;

class panitiaController extends Controller
{

    //CONSTANT VALUES FOR MEMBER STATUS
    public const ACTIVE_MEMBER = 1;
    public const NON_ACTIVE_MEMBER = 2;
    public const UNVERIFIED_MEMBER = 3;

    //CONSTANT VALUES FOR MEMBER JABATAN
    public const KETUA = 1;
    public const SEKRETARIS = 2;
    public const BENDAHARA = 3;
    public const TAKMIR = 4;
    public const REMAS = 5;
     //CONSTANT VALUES FOR MEMBER STATUS
     public const BUKAN_PANITIA = 0;
   
    //CONSTANT VALUES FOR PANITIA
    public const KETUA_PANITIA = 1;
    public const SEKRETARIS_PANITIA = 2;
    public const PERALATAN = 3;
    public const HUMAS = 4;

    public function getPosisi(Panitia $panitia)
    {
        switch ($panitia->panitia_id) {
            case (self::KETUA_PANITIA):
                return 'Ketua Panitia';
                break;
            case (self::SEKRETARIS_PANITIA):
                return 'Sekretaris Panitia';
                break;
            case (self::PERALATAN):
                return 'Peralatan';
                break;
            case (self::HUMAS):
                return 'Humas';
                break;
          
        }
    }
      public function getDetail(Panitia $panitia)
    {
        $panitia = panitia::get()->where('id', $panitia->id)->first();
        $panitia->nama = $panitia->anggota->nama;
         
        $panitia->telp = $panitia->anggota->telp;

        
    
        return $panitia;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $anggotaPanitia = panitia::get();
        $belumPanitia = anggota::get();
        $adaketuapanitia = false;
        if(panitia::where('panitia_id','=',1)->count()>0){
            $adaketuapanitia =true;
        }

        // {{-- kumpulan id anggota yang sudah jadi panitia --}}
        $idnyaAnggota = array();
        foreach ($anggotaPanitia as $panitia){
           $idnyaAnggota[] = $panitia->anggota_id; 
        }
 //tambahkan keterangan status dan jabatan dalam string
        foreach ($anggotaPanitia as $panitia) {
            $panitia->posisi =  $this->getPosisi($panitia);
        }


        $data = [
            'anggotaPanitia' => $anggotaPanitia,
            'belumPanitia' =>$belumPanitia,
            'adaketuapanitia'=> $adaketuapanitia,
            'idnyaAnggota'=>$idnyaAnggota
            
        ];
        //retval
        return view('kurban.panitia', $data);
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
        
        panitia::create([
            'anggota_id' => $request->idAnggota,
            'panitia_id'=> $request ->idJabatan
            ]);
            return redirect()->route('manajPanitia')->with('status','Panitia berhasil ditambahkan');
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        panitia::where('id', $request->id)
        ->update([
            'panitia_id' => $request->idJabatan,
            ]);
            return redirect()->route('manajPanitia')->with('status','Panitia berhasil diubah');
        
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        panitia::destroy($request->id);
        return redirect()->route('manajPanitia')->with('status','Panitia berhasil dihapus');
    }
}
