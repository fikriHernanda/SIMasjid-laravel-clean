<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// basic route login,register,reset-password
Auth::routes();
Route::view('/after_register', 'auth.after_register')->name('afterRegister');

//pakai middleware auth
Route::middleware('auth')->group(function () {

    //route home
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/panitia','panitiaController@index')->name('manajPanitia');
    Route::get('/panitia/detail/{panitia}','panitiaController@getDetail')->name('panitiaDetail');
    Route::patch('/panitia/tambah','panitiaController@store')->name('tambahPanitia');
    Route::post('/panitia/hapus','panitiaController@destroy')->name('hapusPanitia');      
    Route::patch('/panitia/ubah','panitiaController@update')->name('editPanitia');    
    //katalog
    Route::get('/katalog_kurban','katalogKurbanController@index')->name('manajKurban');
    Route::post('/katalog_kurban/tambah','katalogKurbanController@store')->name('tambahKurban');
    Route::get('/katalog_kurban/detail/{id}', 'katalogKurbanController@getDetail')->name('kurbanDetail');
    Route::get('/katalogKurban/{kurban}/edit','katalogKurbanController@edit');
    Route::patch('/katalogKurban/{kurban}/update','katalogKurbanController@update');
    Route::delete('/katalogKurban/delete','katalogKurbanController@destroy');
    //pekurban
    Route::get('/pekurban','pekurbanController@index')->name('manajPekurban');
    Route::patch('/pekurban/tambah','pekurbanController@store')->name('tambahPekurban');
    Route::get('/pekurban/detail/{id}','pekurbanController@getDetail')->name('pekurbanDetail');
    Route::GET('/pekurban/{pekurban}/edit','pekurbanController@edit')->name('editPekurban');
    Route::patch('/pekurban/{pekurban}/update','pekurbanController@update')->name('updatePekurban');
    Route::delete('/pekurban/delete','pekurbanController@destroy')->name('hapus_pekurban');
    Route::get('/pekurban/exportpdf/{id}','pekurbanController@exportPDF')->name('cetakPekurban');
    //urunan
    Route::get('/pekurban/urunan','pekurbanController@lihatUrunan')->name('manajUrunan');
    Route::post('/pekurban/TambahUrunan','pekurbanController@tambahUrunan')->name('tambahPatunganPekurban');

   //prediksi
    Route::get('/prediksi','prediksiController@index')->name('manajPrediksi');
    Route::get('/penerima','penerimaKurbanController@index')->name('manajPenerimaKurban');
    Route::post('/penerima/tambah','penerimaKurbanController@store')->name('tambahPenerima');
    Route::get('/penerima/detail/{id}','penerimaKurbanController@getDetail');
    Route::post('/penerima/delete','penerimaKurbanController@destroy');
    Route::get('/penerima/{id}/edit','penerimaKurbanController@edit');
    Route::patch('/penerima/{id}/update','penerimaKurbanController@update');
    //penyembelih
    Route::get('/penyembelih','penyembelihController@index')->name('manajPenyembelih');
    Route::post('/penyembelih/tambah','penyembelihController@store')->name('tambahPenyembelih');
    Route::get('/penyembelih/detail/{id}','penyembelihController@getDetail');
    Route::post('/penyembelih/delete','penyembelihController@destroy');
    Route::get('/penyembelih/{id}/edit','penyembelihController@edit');
    Route::patch('/penyembelih/{id}/update','penyembelihController@update');
    //pekerjaan
    Route::get('/pekerjaan','pekerjaanController@index')->name('manajPekerjaan');
    Route::post('/pekerjaan/tambah','pekerjaanController@store')->name('tambahPekerjaan');
    Route::get('/pekerjaan/{id}/edit','pekerjaanController@edit');
    Route::patch('/pekerjaan/{id}/update','pekerjaanController@update');
    Route::get('/pekerjaan/detail/{id}','pekerjaanController@getDetail');
    Route::post('/pekerjaan/delete','pekerjaanController@destroy');

    //peralatan
    Route::get('/peralatan','peralatanController@index')->name('manajPeralatan');
    Route::post('/perlatan/tambah','peralatanController@store')->name('tambahPeralatan');
    Route::get('/peralatan/{id}/edit','peralatanController@edit');
    Route::patch('/peralatan/{id}/update','peralatanController@update');
    Route::get('/peralatan/detail/{id}','peralatanController@getDetail');
    Route::delete('/pekerjaan/delete','peralatanController@destroy');
    // group untuk anggota aktif
    Route::middleware('CheckStatus')->group(function () {
        //route keanggotaan
        Route::get('anggota', 'Anggota\AnggotaController@index')->name('anggotaIndex');
        Route::get('anggota/detail/{id}', 'Anggota\AnggotaController@getDetail')->name('anggotaDetail');
        //edit, delete anggota
        Route::post('anggota/delete', 'Anggota\AnggotaController@delete')->name('anggotaDelete');
        Route::post('anggota/edit', 'Anggota\AnggotaController@edit')->name('anggotaEdit');
        //verifikasi anggota
        Route::get('anggota/verifikasi', 'Anggota\VerifikasiController@index')->name('anggotaIndexVerifikasi');
        Route::post('anggota/verifikasi/tolak', 'Anggota\VerifikasiController@tolak')->name('anggotaTolakVerif');
        Route::post('anggota/verifikasi/terima', 'Anggota\VerifikasiController@terima')->name('anggotaTerimaVerif');

        //JSON list
        Route::post('read_notif_json', 'NotifikasiController@read')->name('notifReadJSON');

        //route profil
        Route::get('/profile', 'Profile\ProfileController@index')->name('profile');
        Route::post('/profile', 'Profile\ProfileController@uploadFoto')->name('uploadFotoProfile');

        //route pengaturan_akun
        Route::get('/pengaturan_akun', 'Pengaturan_Akun\PengaturanAkunController@index')->name('pengaturanAkun');
        Route::post('/pengaturan_akun/update', 'Pengaturan_Akun\PengaturanAkunController@update')->name('pengaturanAkunUpdate');
    });
    

});
