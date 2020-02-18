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
                            <li class="breadcrumb-item active">Edit Katalog Kurban</li>
                        </ol>
                </div>
            <div class="section-body">
            <form method="POST" action="{{ route('home') }}/katalogKurban/{{$kurban->id}}/update" class="needs-validation" novalidate="">
                            @method('patch')
                            @csrf                             
                        <div class="form-group">
                                <label>Jenis Kurban</label>
                                <input type="text" class="form-control" value="{{$kurban->jenis_kurban->jenis}}" required="" disabled>
                        </div>
                        <div class="form-group">
                            <label>Kategori</label>
                            <input type="text" class="form-control" value="{{$kurban->kelas_kurban->kelas}}" required="" disabled>
                        </div>
                        <div class="form-group">
                              <label>Harga</label>
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <div class="input-group-text">
                                    Rp
                                  </div>
                                </div>
                                <input type="text" class="form-control currency" name="harga" value="{{$kurban->harga}}">
                              </div>
                        </div>
                        <div class="form-group">
                                <label>Berat Hewan</label>
                                <div class="input-group">
                                  <select name ="satuan" class="custom-select" id="inputGroupSelect05">
                                    <option value="1">Gram (g)</option>
                                    <option selected value="2">KiloGram (kg)</option>
                                  </select>
                                <input name="berat" type="text" class="form-control" value="{{$kurban->berat}}">
                                </div>
                              </div>
                        <div class="form-group">
                            <label>Detail Hewan</label>
                            <input type="text" class="form-control" name="keterangan" placeholder="Perkiraan Berat" value="{{$kurban->keterangan}}" name="keterangan">
                        </div>
                        <div class="" bg-whitesmoke br>
                        <a href="{{route('manajKurban')}}"  class="btn btn-secondary" >Batal</a>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
            </div>
            </form>
        </section>
</div>






{{-- //menampilkanformatharga rupiah --}}
    <script>
    var formatter = new Intl.NumberFormat('id', {
    style: 'currency',
    currency: 'IDR',
          });
    var amount = document.getElementsByClassName('input');
    for (i = 0; i < amount.length; i++) {
        amount[i].innerHTML = formatter.format(amount[i].innerHTML);  
          
    }
    </script>

@include('layouts.footer')