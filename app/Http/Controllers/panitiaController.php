<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anggota\Anggota;
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

    public function getPosisi(Anggota $anggota)
    {
        switch ($anggota->id_panitia) {
            case (self::KETUA_PANITIA):
                return 'Ketua Panitia';
                break;
            case (self::SEKRETARIS_PANITIA):
                return 'Sekretaris Panitia';
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
        $anggotaPanitia = Anggota::get()->where('id_panitia', '!=', self::BUKAN_PANITIA);
        $belumPanitia = Anggota::get()->where('id_panitia', '==', 0);
        $adaketuapanitia = false;
        if(Anggota::where('id_panitia','=',1)->count()>0){
            $adaketuapanitia =true;
        }

        //tambahkan keterangan status dan jabatan dalam string
        foreach ($anggotaPanitia as $anggota) {
            $anggota->posisi =  $this->getPosisi($anggota);
        }


        $data = [
            'anggotaPanitia' => $anggotaPanitia,
            'belumPanitia'   => $belumPanitia,
            'adaketuapanitia'=> $adaketuapanitia
            
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
        
        Anggota::where('id', $request->anggota)
        ->update([
            'id_panitia' => $request->idJabatan,
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
        Anggota::where('id', $request->id)
        ->update([
            'id_panitia' => $request->idJabatan,
            ]);
            return redirect()->route('manajPanitia')->with('status','Panitia berhasil dihapus');
        
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Anggota::where('id', $request->id)
        ->update([
            'id_panitia' => 0,
            ]);
            return redirect()->route('manajPanitia')->with('status','Panitia berhasil dihapus');
    }
}
