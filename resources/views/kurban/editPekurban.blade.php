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
          
                    <form method="POST" action="{{ route('home') }}/pekurban/{{$pekurban->id}}/update">
                            @method('patch')
                            @csrf  
                        <div class="form-group">
                                <label>Nama Pekurban</label>
                        <input type="text" class="form-control @error('namaPekurban') is-invalid @enderror" name="namaPekurban" value="{{$pekurban->nama}}">
                        @error('namaPekurban')
                        <div class="invalid-feedback">     
                                {{$message}}
                        </div>  
                        @enderror 
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                        <input type="text" class="form-control" name="alamat" value="{{$pekurban->alamat}}">
                        </div>
                        <div class="form-group">
                            <label>Nomor Telepon</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <div class="input-group-text">
                                  <i class="fas fa-phone"></i>
                                </div>
                              </div>
                            <input type="text" class="form-control phone-number" name="noHp" value="{{$pekurban->no_hp}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Kurban</label>
                            <select id="sel" class="form-control" name="jenis" onchange="getSelectValue()">
                            <option value="{{$pekurban->kurban->harga}}">{{$pekurban->kurban->jenis_kurban->jenis}} Kategori {{$pekurban->kurban->kelas_kurban->kelas}}</option>
                            @foreach ($kurbans as $kurban)
                           @if($kurban->harga ==  $pekurban->kurban->harga)
                            <?php continue;?> 
                           @endif
                            <option value="{{$kurban->harga}}">{{$kurban->jenis_kurban->jenis}} Kategori {{$kurban->kelas_kurban->kelas}}</option>
                            @endforeach
                          </select>  
                        </div>
                        <div class="form-group">
                            <label>Harga</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <div class="input-group-text">
                                  Rp
                                </div>
                              </div>
                              <input id="outputharga"  type="text" class="form-control"  disabled>
                              <input id="outputharga2"  type="hidden" class="form-control currency" name="paramHarga">
                            </div>
                        </div>
                        <div class="form-group">
                                <label>Status Kurban</label>
                                <select id="sel" class="form-control" name="status" onchange="getSelectValue()">
                                <option value="{{$pekurban->status_kurban->id}}">{{$pekurban->status_kurban->status}}</option>
                                @foreach ($status_kurban as $status_kurban)
                                @if($status_kurban->id ==  $pekurban->status_kurban->id)
                                <?php continue;?> 
                                 @endif
                                <option value="{{$status_kurban->id}}">{{$status_kurban->status}}</option>
                                @endforeach
                              </select>  
                            </div>
                        <button type="button" class="btn btn-secondary" >Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
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
     <script>
            function getSelectValue(){
              var selectedValue = document.getElementById("sel").value;
              var formatter = new Intl.NumberFormat('id', {
                style: 'decimal'
                      });
              document.getElementById("outputharga").value = formatter.format(selectedValue); 
              document.getElementById("outputharga2").value =selectedValue; 
              
              console.log(selectedValue);
            }
            getSelectValue();
              //}
            </script>

@include('layouts.footer')