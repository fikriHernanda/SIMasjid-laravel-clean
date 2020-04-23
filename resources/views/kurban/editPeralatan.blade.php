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
                <form method="POST" action="{{route('home') }}/peralatan/{{$peralatan->id}}/update">
                    @csrf  
                    @method('patch')
                <div class="form-group">
                        <label>Nama Peralatan</label>
                <input type="text" class="form-control" name="namaperalatan" value="{{$peralatan->nama}}">
                </div>
                <div class="form-group">
                        <label>Jumlah</label>
                        <input type="number" class="form-control" name="jumlah" value="{{$peralatan->jumlah}}">
                </div>
                <div class="form-group">
                    <label>Satuan</label>
                <select name="satuan"  class="form-control" style="margin-bottom:10px; width:100%;" value="{{$peralatan->id_satuan}}" >
                        <option value="1">Unit</option>
                        <option value="2">Lembar</option>
                        <option value="3">Pak</option>
                        <option value="4">Set</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Keterangan</label>
                    <input type="text" class="form-control" name="keterangan" placeholder="contoh : 1 pak berisi 10 buah" value="{{$peralatan->keterangan}}">
                </div>
                <div class="form-group">
                    <label>Status Penerima</label>
                <select  id="sel" class="form-control" name="status" value="{{$peralatan->id_status}}" >
                            <option value="1">Belum Tersedia</option>
                            <option value="2">Disimpan</option>
                    </select>  
                </div>
                <div style="float:right">
                <button  type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
    </div>
       
         
    </form>
          
        </section>
</div>

@include('layouts.footer')