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
                            <li class="breadcrumb-item"><a href="{{ route('manajPekerjaan') }}">Pekerjaan Persiapan Kurban</a></li>
                            <li class="breadcrumb-item active">Edit Pekerjaan Persiapan Kurban</li>
                        </ol>
                </div>
            <div class="section-body" style="height : 550px;">
                        <form method="POST" action="{{ route('home') }}/pekerjaan/{{$pekerjaan->id}}/update">
                         @method('patch')
                            @csrf  
                        <div class="form-group">
                                <label>Nama Aktivitas </label>
                        <input type="text" class="form-control" name="namaaktivitas" value="{{$pekerjaan->nama_aktivitas}}">
                        </div>
                        <div class="form-group">
                            <label>Penanggung Jawab</label>
                        <select name="penanggungjawab"  class="form-control" style="margin-bottom:10px; width:100%;" value="{{$pekerjaan->panitia->id}}" >
                            @foreach($panitia as $panitia)
                            <option value="{{$panitia->id}}">{{$panitia->anggota->nama}}</option>
                            <?php if($panitia->id == $pekerjaan->panitia_id){
                                continue;
                            }?>
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                                        <label>Status Pekerjaan</label>
                                <select  id="sel" class="form-control" name="status">
                                        <option value="1">Dalam Daftar</option>
                                        <option value="2">Dikerjakan</option>
                                        <option value="3">Selesai Dikerjakan</option>
                                </select>  
                        </div>
                        <div class="form-group">
                                <label>Keterangan</label>
                        <input value="{{$pekerjaan->keterangan}}"type="text" class="form-control" name="keterangan" placeholder="contoh : mengasuh 250 orang">
                        </div>
                                <div class="row" style="float:right; margin-top:30px;">
                                <a href="" class="btn btn-secondary" style="margin:5px" data-dismiss="modal">Kembali</a>
                                <button type="submit" class="btn btn-primary" style="margin:5px">Simpan</button>
                                </div>
                        </form>
          
        </section>
</div>

@include('layouts.footer')