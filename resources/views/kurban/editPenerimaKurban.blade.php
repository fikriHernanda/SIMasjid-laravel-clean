@include('layouts.header')
@include('layouts.navbar')


<?php
/* PHP UNTUK PENGATURAN VIEW */
//anggota terautentikasi
$authUser = Auth::user();
//hide untuk selain sekretaris dan ketua
$sekretaris = array(1, 2);
$inside_sekretaris = in_array($authUser->id_jabatan, $sekretaris);
?>
<div class="main-content" style="min-height: 874px;">
        <section class="section">
                <div class="section-header">
                        <ol class="breadcrumb float-sm-left" style="margin-bottom: 10px; margin-left: 15px;">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-mosque"></i> Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('manajPenerimaKurban') }}">Penerima Kurban</a></li>
                            <li class="breadcrumb-item active">Edit Penerima Kurban</li>
                        </ol>
                </div>
            <div class="section-body" style="height : 650px;">
                        <form method="POST" action="{{ route('home') }}/penerima/{{$penerima->id}}/update">
                         @method('patch')
                            @csrf  
                        <div class="form-group">
                                <label>Nama Penerima Kurban</label>
                        <input type="text" class="form-control" name="nama" value="{{$penerima->nama}}">
                        </div>
                        <div class="form-group">
                                <label>Alamat</label>
                        <input type="text-area" class="form-control" name="alamat" value="{{$penerima->alamat}}">
                            </div>
                        <div class="form-group">
                                    <label>Nomor Telepon</label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <div class="input-group-text">
                                          <i class="fas fa-phone"></i>
                                        </div>
                                      </div>
                                <input type="text" class="form-control phone-number" name="noHp" value="{{$penerima->no_hp}}">
                        </div>
                        <div  class="form-group">
                                <label>Jenis Penerima</label>
                        <select  value="{{$penerima->jenis}}"id="sel" class="form-control" name="jenis" >
                                <option value="Perorangan">Perorangan</option>
                                <option value="Lembaga/Yayasan">Lembaga/Yayasan </option>
                        </select>  
                        </div>
                        <div class="form-group">
                                        <label>Status Penerima</label>
                                <select  id="sel" class="form-control" name="status" >
                                        <option value="Terdaftar">Terdaftar</option>
                                        <option value="Teralokasi">Sudah Diantar / Diambil </option>
                                </select>  
                        </div>
                        <div class="form-group">
                                <label>Detail</label>
                        <input value="{{$penerima->keterangan}}"type="text" class="form-control" name="keterangan" placeholder="contoh : mengasuh 250 orang">
                        </div>
                                <div class="row" style="float:right; margin-top:30px;">
                                <a href="" class="btn btn-secondary" style="margin:5px" data-dismiss="modal">Kembali</a>
                                <button type="submit" class="btn btn-primary" style="margin:5px">Simpan</button>
                                </div>
                        </form>
          
        </section>
</div>

@include('layouts.footer')