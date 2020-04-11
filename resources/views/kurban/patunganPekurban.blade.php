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

<div class="main-content">
    <section class="section">
         <div class="row">
            <ol class="breadcrumb float-sm-left" style="margin-bottom: 10px; margin-left: 15px;">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-mosque"></i> Home</a></li>
                <li class="breadcrumb-item active">Urunan Kurban</li>
            </ol>
        </div>
        <div class="section-header">
            <div class="row" style="margin:auto;">
                <div class="col-12">
                    <h1><i class="fa fa-address-book"></i> Daftar Pekurban Urunan Sementara Masjid Ibnu Sina</h1>
                    <div></div>
                </div>
            </div>
        </div>
        <div class="section-body">
            <button class="btn btn-primary mt-3"  data-toggle="modal" id="togglemodal" data-target="#modalTambah">Tambah Kelompok</button>
            <a  href="{{route('home')}}/pekurban" class="btn btn-info mt-3"  >Kembali ke Daftar Pekurban</a>
            
            <div class="row">
                <button style="margin: 1em auto;" class="btn btn-dark" data-toggle="collapse" data-target="#filter-box">
                    <i class="fa fa-filter"></i> Show/Close Filter Data
                </button>
                <div class="col-12">
                    <div id="filter-box" class="collapse">
                        <div class="card-body">
                            <h6 style="text-align:center"><i class="fa fa-filter"></i> Filter Data</h6>
                            <div class="column-search"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <table id="table_id1" class="table table-striped table-bordered " style="padding-bottom:20px;">
                        <thead>
                            <tr>
                                <th class="dt-center">No</th>
                                <th class="dt-center">Nama</th>
                                <th class="dt-center">Nomor HP</th>
                                <th class="dt-center">Alamat</th>
                                <th class="dt-center">Kurban</th>
                                <th class="dt-center">Permintaan</th>
                                <th class="dt-center">Status</th>
                                <th class="dt-center">Kloter</th>
                                <th class="dt-center">Keterangan</th>
                                <th class="dt-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($list))
                            @foreach ($list as $pekurban)
                            
                            <tr>
                                <td class="dt-center">{{ $loop->iteration }}</td>
                                <td>{{ $pekurban->nama}}</td>
                                <td>{{ $pekurban->no_hp }}</td>
                                <td>{{ $pekurban->alamat }}</td>
                            <td>{{$pekurban->kurban->jenis_kurban->jenis}} Kategori {{$pekurban->kurban->kelas_kurban->kelas}}</td>
                                <td>{{$pekurban->bagian_kurban->bagian}}</td>
                                <td class="font-status">{{$pekurban->status_kurban->status }}</td>
                                <td>{{$pekurban->patungan_kurban }}</td>
                                <td>{{$pekurban->keterangan }}</td>
                                <td class="dt-center">
                                    <div class="btn-group mb-3" role="group" aria-label="Basic example" style="padding-left: 20px;">
                                        <a href="#" class="open-detail btn btn-icon btn-sm btn-info" data-toggle="modal" data-id="{{ $pekurban->id }}" data-target="#detailModal"><i class="fas fa-id-badge"></i> Detail</a>
                                    <a href="{{route('home')}}/pekurban/{{$pekurban->id}}/edit" class="open-edit btn btn-icon btn-sm btn-primary" ><i class="fas fa-sync"></i></i> Perbarui</a>
                                        <a href="#" class="open-delete btn btn-icon btn-sm btn-danger" data-toggle="modal" data-id="{{ $pekurban->id }}" data-target="#deleteModal"><i class="fas fa-trash"></i> Hapus</a> 
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
{{-- modal TAMBAH --}}
<?php $bagianmodal = $bagian;
?>
<div class="modal fade" tabindex="-1" role="dialog" id="modalTambah">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Menambahkan Pekurban</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div id="modalBody" class="modal-body">
            <form id="regForm" action="{{route('tambahPatunganPekurban')}}" method="POST">
                    @csrf
                    {{-- <input value="1" class="form-control" id="jmlpekurban" type="number" onkeyup="showKrban()"> --}}
                    <div id="divsel" class="form-group mt-3">
                            <label>Kurban</label>
                            <select id="sel" class="form-control" name="jenis" onchange="getSelectValue()">
                            
                            @foreach ($kurban as $kurban)
                            <option value="{{$kurban->harga}}">{{$kurban->jenis_kurban->jenis}} Kategori {{$kurban->kelas_kurban->kelas}}</option>
                            @endforeach
                            </select>  
                    </div>
                    <div id="divsel2" class="form-group">
                            <label>Harga</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <div class="input-group-text">
                                  Rp
                                </div>
                              </div>
                              <input id="outputharga"  type="text" class="form-control"  disabled>
                              <input id="outputharga2"  type="hidden" class="form-control " name="paramHarga">
                    </div>
                        <h4 class="mt-3">Patungan Kurban:</h4>
                        <!-- One "tab" for each step in the form: -->
                        <div id="tabdiv">
                        <div class="tab">
                            <div class="form-group">
                                    <label>Nama Pekurban</label>
                                    <input type="text" class="form-control" name="namaPekurban[]">
                            </div>
                            <div class="form-group">
                                    <label>Alamat</label>
                                    <input type="text-area" class="form-control" name="alamat[]">
                                </div>
                            <div class="form-group">
                                        <label>Nomor Telepon</label>
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <div class="input-group-text">
                                              <i class="fas fa-phone"></i>
                                            </div>
                                          </div>
                                          <input type="text" class="form-control phone-number" name="noHp[]">
                                        </div>
                            </div>
                            <div class="form-group">
                                    <label>Permintaan bagian</label>
                                    <select  class="form-control" name="bagianKurban[]" onchange="">     
                                    @foreach ($bagianmodal as $bagian)
                                    <option value="{{$bagian->id}}">{{$bagian->bagian}} {{$bagian->jenis_kurban->jenis}}</option>
                                    @endforeach
                                    </select>  
                            </div>
                            <div class="form-group">
                                    <label>Keterangan</label>
                                    <textarea name="keterangan" class="form-control"></textarea>
                            </div>
                            </div>
                        </div>
                        <div class="tab">
                                <div class="form-group">
                                        <label>Nama Pekurban</label>
                                        <input type="text" class="form-control" name="namaPekurban[]">
                                </div>
                                <div class="form-group">
                                        <label>Alamat</label>
                                        <input type="text-area" class="form-control" name="alamat[]">
                                    </div>
                                <div class="form-group">
                                            <label>Nomor Telepon</label>
                                            <div class="input-group">
                                              <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                  <i class="fas fa-phone"></i>
                                                </div>
                                              </div>
                                              <input type="text" class="form-control phone-number" name="noHp[]">
                                            </div>
                                </div>
                                <div class="form-group">
                                        <label>Permintaan bagian</label>
                                        <select  class="form-control" name="bagianKurban" onchange="">   
                                        @foreach ($bagianmodal as $bagian)
                                        <option value="{{$bagian->id}}">{{$bagian->bagian}} {{$bagian->jenis_kurban->jenis}}</option>
                                        @endforeach
                                        </select>  
                                </div>
                                <div class="form-group">
                                        <label>Keterangan</label>
                                        <textarea name="keterangan" class="form-control"></textarea>
                                </div>
                        </div>
                        <div class="tab">
                                <div class="form-group">
                                        <label>Nama Pekurban</label>
                                        <input type="text" class="form-control" name="namaPekurban[]">
                                </div>
                                <div class="form-group">
                                        <label>Alamat</label>
                                        <input type="text-area" class="form-control" name="alamat[]">
                                    </div>
                                <div class="form-group">
                                            <label>Nomor Telepon</label>
                                            <div class="input-group">
                                              <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                  <i class="fas fa-phone"></i>
                                                </div>
                                              </div>
                                              <input type="text" class="form-control phone-number" name="noHp[]">
                                            </div>
                                </div>
                                <div class="form-group">
                                    <label>Permintaan bagian</label>
                                    <select  class="form-control" name="bagianKurban" onchange="">   
                                    @foreach ($bagianmodal as $bagian)
                                    <option value="{{$bagian->id}}">{{$bagian->bagian}} {{$bagian->jenis_kurban->jenis}}</option>
                                    @endforeach
                                    </select>  
                            </div>
                            <div class="form-group">
                                    <label>Keterangan</label>
                                    <textarea name="keterangan" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="tab">
                                <div class="form-group">
                                        <label>Nama Pekurban</label>
                                        <input type="text" class="form-control" name="namaPekurban[]">
                                </div>
                                <div class="form-group">
                                        <label>Alamat</label>
                                        <input type="text-area" class="form-control" name="alamat[]">
                                    </div>
                                <div class="form-group">
                                            <label>Nomor Telepon</label>
                                            <div class="input-group">
                                              <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                  <i class="fas fa-phone"></i>
                                                </div>
                                              </div>
                                              <input type="text" class="form-control phone-number" name="noHp[]">
                                            </div>
                                </div>
                                <div class="form-group">
                                    <label>Permintaan bagian</label>
                                    <select  class="form-control" name="bagianKurban" onchange="">   
                                    @foreach ($bagianmodal as $bagian)
                                    <option value="{{$bagian->id}}">{{$bagian->bagian}} {{$bagian->jenis_kurban->jenis}}</option>
                                    @endforeach
                                    </select>  
                            </div>
                            <div class="form-group">
                                    <label>Keterangan</label>
                                    <textarea name="keterangan" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="tab">
                                <div class="form-group">
                                        <label>Nama Pekurban</label>
                                        <input type="text" class="form-control" name="namaPekurban[]">
                                </div>
                                <div class="form-group">
                                        <label>Alamat</label>
                                        <input type="text-area" class="form-control" name="alamat[]">
                                    </div>
                                <div class="form-group">
                                            <label>Nomor Telepon</label>
                                            <div class="input-group">
                                              <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                  <i class="fas fa-phone"></i>
                                                </div>
                                              </div>
                                              <input type="text" class="form-control phone-number" name="noHp[]">
                                            </div>
                                </div>
                                <div class="form-group">
                                    <label>Permintaan bagian</label>
                                    <select  class="form-control" name="bagianKurban" onchange="">   
                                    @foreach ($bagianmodal as $bagian)
                                    <option value="{{$bagian->id}}">{{$bagian->bagian}} {{$bagian->jenis_kurban->jenis}}</option>
                                    @endforeach
                                    </select>  
                            </div>
                            <div class="form-group">
                                    <label>Keterangan</label>
                                    <textarea name="keterangan" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="tab">
                                <div class="form-group">
                                        <label>Nama Pekurban</label>
                                        <input type="text" class="form-control" name="namaPekurban[]">
                                </div>
                                <div class="form-group">
                                        <label>Alamat</label>
                                        <input type="text-area" class="form-control" name="alamat[]">
                                    </div>
                                <div class="form-group">
                                            <label>Nomor Telepon</label>
                                            <div class="input-group">
                                              <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                  <i class="fas fa-phone"></i>
                                                </div>
                                              </div>
                                              <input type="text" class="form-control phone-number" name="noHp[]">
                                            </div>
                                </div>
                                <div class="form-group">
                                    <label>Permintaan bagian</label>
                                    <select  class="form-control" name="bagianKurban" onchange="">   
                                    @foreach ($bagianmodal as $bagian)
                                    <option value="{{$bagian->id}}">{{$bagian->bagian}} {{$bagian->jenis_kurban->jenis}}</option>
                                    @endforeach
                                    </select>  
                            </div>
                            <div class="form-group">
                                    <label>Keterangan</label>
                                    <textarea name="keterangan" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="tab">
                                <div class="form-group">
                                        <label>Nama Pekurban</label>
                                        <input type="text" class="form-control" name="namaPekurban[]">
                                </div>
                                <div class="form-group">
                                        <label>Alamat</label>
                                        <input type="text-area" class="form-control" name="alamat[]">
                                    </div>
                                <div class="form-group">
                                            <label>Nomor Telepon</label>
                                            <div class="input-group">
                                              <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                  <i class="fas fa-phone"></i>
                                                </div>
                                              </div>
                                              <input type="text" class="form-control phone-number" name="noHp[]">
                                            </div>
                                </div>
                                <div class="form-group">
                                    <label>Permintaan bagian</label>
                                    <select  class="form-control" name="bagianKurban" onchange="">   
                                    @foreach ($bagianmodal as $bagian)
                                    <option value="{{$bagian->id}}">{{$bagian->bagian}} {{$bagian->jenis_kurban->jenis}}</option>
                                    @endforeach
                                    </select>  
                            </div>
                            <div class="form-group">
                                    <label>Keterangan</label>
                                    <textarea name="keterangan" class="form-control"></textarea>
                            </div>
                        </div>
                        </div>
                        <div id="tombol"style="overflow:auto;">
                          <div style="float:right;">
                            <button type="button" id="prevBtn" onclick="nextPrev(-1)">Sebelumnya</button>
                            <button type="button" id="nextBtn" onclick="nextPrev(1)">Berikutnya</button>
                          </div>
                        </div>
                        <!-- Circles which indicates the steps of the form: -->
                        <div id="divstep" style="text-align:center;margin-top:40px;">
                          <span class="step"></span>
                          <span class="step"></span>
                          <span class="step"></span>
                          <span class="step"></span>
                          <span class="step"></span>
                          <span class="step"></span>
                          <span class="step"></span>
                        </div>
                </form>


            {{-- <form method="POST" action="{{route('tambahPatunganPekurban')}}">
                    @method('patch')
                            @csrf  
                        <div class="form-group">
                                <label>Nama Pekurban</label>
                                <input type="text" class="form-control" name="namaPekurban">
                        </div>
                        <div class="form-group">
                                <label>Alamat</label>
                                <input type="text-area" class="form-control" name="alamat">
                            </div>
                        <div class="form-group">
                                    <label>Nomor Telepon</label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <div class="input-group-text">
                                          <i class="fas fa-phone"></i>
                                        </div>
                                      </div>
                                      <input type="text" class="form-control phone-number" name="noHp">
                                    </div>
                        </div>
                        {{-- <div class="form-group">
                            <div class="control-label">Patungan Sapi?</div>
                            <label class="custom-switch mt-2">
                              <input id="cekbox" type="checkbox" name="custom-switch-checkbox" class="custom-switch-input">
                              <span class="custom-switch-indicator"></span>
                              <span class="custom-switch-description">Ya</span>
                            </label>
                          </div> --}}
                          {{-- <div id="divsel" class="form-group">
                                <label>Kurban</label>
                                <select id="sel" class="form-control" name="jenis" onchange="getSelectValue()">
                                
                                @foreach ($kurban as $kurban)
                                <option value="{{$kurban->harga}}">{{$kurban->jenis_kurban->jenis}} Kategori {{$kurban->kelas_kurban->kelas}}</option>
                                @endforeach
                                </select>  
                        </div>
                        <div id="divsel2" class="form-group">
                                <label>Harga</label>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <div class="input-group-text">
                                      Rp
                                    </div>
                                  </div>
                                  <input id="outputharga"  type="text" class="form-control"  disabled>
                                  <input id="outputharga2"  type="hidden" class="form-control " name="paramHarga">
                                </div>
                        </div>
                        <div class="form-group">
                                <label>Permintaan bagian</label>
                                <select  class="form-control" name="bagianKurban" onchange="">     
                                @foreach ($bagian as $bagian)
                                <option value="{{$bagian->id}}">{{$bagian->bagian}} {{$bagian->jenis_kurban->jenis}}</option>
                                @endforeach
                                </select>  
                        </div>
                        <div class="form-group">
                                <label>Keterangan</label>
                                <textarea name="keterangan" class="form-control"></textarea>
                        </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form> --}} 
            </div>
        </div>
    </div>
</div>
{{-- modal Tambah --}}
<!-- Modal Detail -->
<div class="modal fade" tabindex="-1" role="dialog" id="detailModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Kurban</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{-- <img src="" id="detailFoto" class="img-thumbnail rounded mx-auto d-block" alt="foto profil" style="max-width:250px; overflow: hidden;"> --}}
                <table class="table table-borderless" style="width:90%; margin: auto;">
                    <tbody>
                        <tr>
                            <th scope="row">Nama</th>
                            <td id="detailNama"></td>
                        </tr>
                        <tr>
                            <th scope="row">Status</th>
                            <td class="font-status" id="detailStatus"></td>
                        </tr>
                        <tr>
                            <th scope="row">Alamat</th>
                            <td id="detailAlamat"></td>
                        </tr>
                        <tr>
                            <th scope="row">Telp/HP</th>
                            <td id="detailTelp"></td>
                        </tr>
                        <tr>
                            <th scope="row">Kurban</th>
                            <td id="detailKurban"></td>
                        </tr>
                        <tr>
                            <th scope="row">Permintaan Bagian</th>
                            <td id="detailPermintaan"></td>
                        </tr>
                        <tr>
                            <th scope="row">Harga Aktual</th>
                            <td id="detailHargaAktual"></td>
                        </tr>
                        <tr>
                            <th scope="row">Tanggal Pendaftaran</th>
                            <td id="detailTGLPendaftaran"></td>
                        </tr>
                    </tbody>
                </table>
                <!-- <input type="text" id="id" name="id" value="" hidden/> -->
            </div>
            <div  id="bottom-modal" class="modal-footer bg-whitesmoke br">
                <a id="tblpdf" class="btn btn-info" href="">Unduh Bukti Pendaftaran</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Delete -->
<div class="modal fade" tabindex="-1" role="dialog" id="deleteModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus Pekurban</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img src="{{ route('home') }}/public/dist/assets/img/svg/trash.svg" id="detailFoto" class="mx-auto d-block" alt="hapus image" style="width:150px; height:150px;overflow: hidden;">

            <h5 id="pesan" align="center"></h5>
            </div>
            <div class="modal-footer bg-whitesmoke br">
            <form action="{{route('home')}}/pekurban/delete" method="post">
                    @csrf
                   @method('delete')
                    <input type="text" id="id_delete" name="id" value="" hidden />
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak, Batalkan</button>
                    <input type="submit" value="Ya, Hapus" class="btn btn-danger" />
                </form>
            </div>
        </div>
    </div>
</div>
<!-- SCRIPT -->
<script type="text/javascript">
    //JQuery Pencarian Berdasarkan Kriteria
    $(document).ready(function() {
        $scroll_table = false;
        if ($(window).width() <= 480) {
            $scroll_table = true;
        }
        var coba = document.getElementById('table_id1');
        console.log(coba);
        $('#table_id1').DataTable({
            scrollX: $scroll_table,
            pageLength: 25,
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'pdfHtml5',
                    text: '<i class="fa fa-file-pdf"></i> PDF',
                    messageTop: 'Daftar  Pekurban',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]
                    }
                },
                {
                    extend: 'print',
                    text: '<i class="fa fa-print"></i> Print',
                    messageTop: 'Daftar Kurban',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]
                    }
                },
            ],
            lengthChange: false,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Kata Kunci Pencarian...",
                zeroRecords: "Data tidak tersedia",
                info: "Menampilkan halaman _PAGE_ dari _PAGES_",
            },
            //kriteria column 0 nama tipe input
            initComplete: function() {
                this.api().columns([1]).every(function() {
                    var column = this;
                    var input = $('<input class="form-control select" placeholder="Nama..." style="margin-bottom:10px;"></input>')
                        .appendTo($(".column-search"))
                        .on('keyup change clear', function() {
                            if (column.search() !== this.value) {
                                column
                                    .search(this.value)
                                    .draw();
                            }
                        });
                });
                //kriteria column 0 nama tipe select
                this.api().columns([4]).every(function() {
                    var column = this;
                    var select = $('<select class="form-control select" style="margin-bottom:10px;"><option value="">Kurban...</option></select>')
                        // .appendTo($(column.header()).empty())
                        .appendTo($(".column-search"))
                        .on('change', function() {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );
                            column
                                .search(val ? '^' + val + '$' : '', true, false)
                                .draw();
                        });
                    column.data().unique().sort().each(function(d, j) {
                        select.append('<option value="' + d + '">' + d + '</option>')
                    });
                });
            }
        });
        status_colorized(); 

    });
  
</script>
<script>
        $(document).on("click", ".open-delete", function() {
              /* passing data dari view button detail ke modal */
              var thisDataAnggota = $(this).data('id');
              $(".modal-footer #id_delete").val(thisDataAnggota);
              var linkDetail = "{{ route('home') }}/pekurban/detail/" + thisDataAnggota;
              
              console.log(linkDetail);
              $.get(linkDetail, function(data) {
                  //deklarasi var obj JSON data detail anggota
                  var obj = data;
                  // ganti elemen pada dokumen html dengan hasil data json dari jquery
              document.getElementById("pesan").innerHTML = "Apakah Anda yakin ingin menghapus pekurban "+ obj.nama+'?';
                
                  //base root project url + url dari db
                  // var link_foto = "{{ route('home') }}/" + obj.link_foto;
                  // document.getElementById("detailFoto").src = link_foto;
              });
          });
        $(document).on("click", ".open-detail", function() {
        /* passing data dari view button detail ke modal */
        var thisDataAnggota = $(this).data('id');
        // $(".modal-body #id").val(thisDataAnggota);
        var linkDetail = "{{ route('home') }}/pekurban/detail/" + thisDataAnggota;
        $.get(linkDetail, function(data) {
            //deklarasi var obj JSON data detail anggota
            var obj = data;
            // ganti elemen pada dokumen html dengan hasil data json dari jquery
            $("#detailNama").html(obj.nama);
            $("#detailTelp").html(obj.no_hp);
            $("#detailStatus").html(obj.status);
            $("#detailAlamat").html(obj.alamat);
            $("#detailKurban").html(obj.jenis +' Kategori '+ obj.kelas);
            $("#detailPermintaan").html(obj.permintaan);
            $("#detailTGLPendaftaran").html(obj.tanggalPendaftaran);
            $("#detailHargaAktual").html(formatter.format(obj.hargaAktual));
           // Create anchor element. 
                 var a = document.getElementById('tblpdf');
                  var linkPdf = "{{route('home')}}/pekurban/exportpdf/"+thisDataAnggota;
                  a.href = linkPdf;
                  status_colorized(); 

                    
                  // Append the anchor element to the body. 
                 

            //base root project url + url dari db
            // var link_foto = "{{ route('home') }}/" + obj.link_foto;
            // $("#detailFoto").attr('src', link_foto);
            // console.log(link_foto);

        });
    });



      </script>

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
          console.log('AA'+selectedValue);
          var formatter = new Intl.NumberFormat('id', {
            style: 'decimal'
                  });
          document.getElementById("outputharga").value = formatter.format(selectedValue);
          document.getElementById("outputharga2").value =selectedValue.replace(/,/g, '');; 
          
          console.log(selectedValue);
        
        }
        getSelectValue();
    
          //  document.getElementById("sel").addEventListener("click", munculHarga);
          // var harga = document.getElementsByClassName('price');
          // var tmp = document.getElementsByClassName('selected');
         
         
          // function munculHarga() {
          //   var idkurban = document.getElementsByClassName("selected").id;
          //   for (i = 0; i < harga.length; i++) {
          //   if(i==idkurban){
             
        //     } 
        // }
          //}
        </script>
        <script>
        function getBagian(){
            var selectedValue = document.getElementById("sel").value;
        }
        </script>
        <script>
                var currentTab = 0; // Current tab is set to be the first tab (0)
                showTab(currentTab); // Display the current tab
                
                function showKrban(){
                    var x = document.getElementsByClassName("tab");
                    var step = document.getElementsByClassName("step");
                    var form = document.getElementById("formReg");
                    var steps = document.getElementById("divstep");
                
                    var jmlpekurban = document.getElementById('jmlpekurban');
                    var child = document.getElementById("tombol");
                    var simpanTab = x[0];
                    var simpanStep = step[0];
                    
                
               
                    //     if(jmlpekurban.value < x.length){
                    //     for(i = 6; i >= jmlpekurban.value; i--){
                    //         x[i].remove();
                    //         step[i].remove();
                    //     }
                    // }

                    //     if(jmlpekurban.value > x.length){
                          
                           
                    //             for(i = x.length; i < jmlpekurban.value; i++){
                    //                 simpanTab.id = "haha";
                    //                 console.log(simpanTab);
                    //                 $("#tabdiv").append(simpanTab);
                    //                 console.log(simpanTab);
                    //             $("#divstep").append("<span class='step active'>"+'</span>');
                    //         }
                    //     }
                }
                // showKrban();
                
                function showTab(n) {
                    // This function will display the specified tab of the form...
                    var x = document.getElementsByClassName("tab");
                    console.log(x[0])
                

                    x[n].style.display = "block";
                    //... and fix the Previous/Next buttons:
                    if (n == 0) {
                        document.getElementById("prevBtn").style.display = "none";
                    } else {
                        document.getElementById("prevBtn").style.display = "inline";
                    }
                    if (n == (x.length - 1)) {
                        document.getElementById("nextBtn").innerHTML = "Submit";
                    } else {
                        document.getElementById("nextBtn").innerHTML = "Berikutnya";
                    }
                    //... and run a function that will display the correct step indicator:
                    fixStepIndicator(n)
                    }
            
                
                function nextPrev(n) {
                  // This function will figure out which tab to display
                  var x = document.getElementsByClassName("tab");
                  // Exit the function if any field in the current tab is invalid:
                  if (n == 1 && !validateForm()) return false;
                  // Hide the current tab:
                  x[currentTab].style.display = "none";
                  // Increase or decrease the current tab by 1:
                  currentTab = currentTab + n;
                  // if you have reached the end of the form...
                  if (currentTab >= x.length) {
                    // ... the form gets submitted:
                    document.getElementById("regForm").submit();
                    return false;
                  }
                  // Otherwise, display the correct tab:
                  showTab(currentTab);
                }
                
                function validateForm() {
                  // This function deals with validation of the form fields
                  var x, y, i, valid = true;
                  x = document.getElementsByClassName("tab");
                  y = x[currentTab].getElementsByTagName("input");
                  // A loop that checks every input field in the current tab:
                  for (i = 0; i < y.length; i++) {
                    // If a field is empty...
                    if (y[i].value == "") {
                      // add an "invalid" class to the field:
                      y[i].className += " invalid";
                      // and set the current valid status to false
                      valid = false;
                    }
                  }
                  // If the valid status is true, mark the step as finished and valid:
                  if (valid) {
                    document.getElementsByClassName("step")[currentTab].className += " finish";
                  }
                  return valid; // return the valid status
                }
                
                function fixStepIndicator(n) {
                  // This function removes the "active" class of all steps...
                  var i, x = document.getElementsByClassName("step");
                  for (i = 0; i < x.length; i++) {
                    x[i].className = x[i].className.replace(" active", "");
                  }
                  //... and adds the "active" class on the current step:
                  x[n].className += " active";
                }
                </script>
                  <script>
                        function status_colorized() {
                     //status aktif bold
                     $(".font-status").css('font-weight', 'bold');
                     /* ganti warna sesuai status */
                     //status aktif ubah warna hijau
                     $(".font-status").filter(function() {
                         return $(this).text() === 'terdaftar';
                     }).css('color', 'green');
                     //status non-aktif ubah warna merah
                     $(".font-status").filter(function() {
                         return $(this).text() === 'Terverifikasi';
                     }).css('color', 'blue');
                     //status belum verifikasi ubah warna abu2
                     $(".font-status").filter(function() {
                         return $(this).text() === 'Menunggu';
                     }).css('color', 'blue');
                 }
             </script>
                
@include('layouts.footer')
