<?php

namespace App\Http\Controllers;
use App\kurban;
use Illuminate\Http\Request;
use App\prediksi;
use App\pekurban;
use Illuminate\Support\Facades\DB;
class prediksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        

       
         $jumlahPekurban = DB::table('pekurban')
         ->join('kurban', 'pekurban.kurban_id', '=', 'kurban.id')
         ->join('kelas_kurban','kurban.kelas_kurban_id','=','kelas_kurban.id')
         ->join('jenis_kurban','kurban.jenis_kurban_id','=','jenis_kurban.id')
         ->select((DB::raw('kelas_kurban.kelas,jenis_kurban.jenis, count(pekurban.id) as jumlahPekurban')))
         ->groupBy('kurban_id')
         ->get();


         $pekurbankambing_A = pekurban::where('kurban_id',1)->count();
         $pekurbankambing_B = pekurban::where('kurban_id',2)->count();
         $pekurbankambing_C = pekurban::where('kurban_id',3)->count();
         $pekurbanSapi_A = pekurban::where('kurban_id',4)->count();
         $pekurbanSapi_B = pekurban::where('kurban_id',5)->count();
         $pekurbanSapi_C = pekurban::where('kurban_id',6)->count();

         $beratPerkurban = array();
         
        $sapi_A = kurban::select('berat')->where([
            ['kelas_kurban_id', '=', '1'],
            ['jenis_kurban_id', '=', '2'],])->first(); 
        $sapi_B = kurban::select('berat')->where([
            ['kelas_kurban_id', '=', '2'],
            ['jenis_kurban_id', '=', '2'],])->first(); 
        $sapi_C =kurban::select('berat')->where([
            ['kelas_kurban_id', '=', '3'],
            ['jenis_kurban_id', '=', '2'],])->first();
        $kambing_A = kurban::select('berat')->where([
                ['kelas_kurban_id', '=', '1'],
                ['jenis_kurban_id', '=', '1'],])->first(); 
        $kambing_B = kurban::select('berat')->where([
                ['kelas_kurban_id', '=', '2'],
                ['jenis_kurban_id', '=', '1'],])->first(); 
        $kambing_C =kurban::select('berat')->where([
                ['kelas_kurban_id', '=', '3'],
                ['jenis_kurban_id', '=', '1'],])->first();  
        
                $beratKurban[0] = $pekurbankambing_A * (int)$kambing_A->berat;
                $beratKurban[1] = $pekurbankambing_B * (int)$kambing_B->berat;
                $beratKurban[2] = $pekurbankambing_C * (int)$kambing_C->berat;  
                $beratKurban[3] = $pekurbanSapi_A * (int) $sapi_A->berat;
                $beratKurban[4] = $pekurbanSapi_B* (int) $sapi_B->berat;
                $beratKurban[5] = $pekurbanSapi_C* (int) $sapi_C->berat;
                $TotalBerat = 0;
              
            foreach($beratKurban as $item){
                $TotalBerat = $item+$TotalBerat;
            }
            
           $prediksi = prediksi::get();
          
         $data = [
            'TotalBerat'=>$TotalBerat,
            'jumlahPekurban'=> $jumlahPekurban,
            'prediksi'=>$prediksi
        ];
        
        //retval
        return view('kurban.prediksiKurban', $data);
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

        $request->validate([
            'berat_kantong' => 'required',
        ]);
        date_default_timezone_set('Asia/Jakarta');
        $date=date_create();
        prediksi::create([
            'jumlah_berat'=>$request->totalBerat,
            'jumlah_kantong'=>$request->hasilKantong,
            'berat_perkantong'=>$request->berat_kantong,
            'created_at'=>$date
        ]);
        return redirect()->route('manajPrediksi');
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
    public function update(Request $request, $id)
    {
        //
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
}
