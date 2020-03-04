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
                <li class="breadcrumb-item active">Katalog Kurban</li>
            </ol>
        </div>
        <div class="section-header">
            <div class="row" style="margin:auto;">
                <div class="col-12">
                    <h1><i class="fa fa-address-book"></i> Daftar Jenis Kurban</h1>
                    <div></div>
                </div>
            </div>
        </div>
        <div class="section-body">
            {{-- <button class="btn btn-primary mt-3"  data-toggle="modal" id="togglemodal" data-target="#modalTambah">Tambah Kurban</button> --}}
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
                                <th class="dt-center">Jenis</th>
                                <th class="dt-center">Kelas</th>
                                <th class="dt-center">Harga</th>
                                <th class="dt-center">Berat</th>
                                <th class="dt-center">Keterangan</th>
                                <th class="dt-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                          
                            @if(isset($list))
                            @foreach ($list as $kurban)
                           
                            <tr>
                                <td class="dt-center">{{ $loop->iteration }}</td>
                                <td>{{ $kurban->jenis_kurban->jenis}}</td>
                                <td>{{ $kurban->kelas_kurban->kelas }}</td>
                                <td class="input">{{ $kurban->harga }}</td>
                                <td>{{ $kurban->berat }} Kg</td>
                                <td>{{ $kurban->keterangan }}</td>
                                <td class="dt-center">
                                    <div class="btn-group mb-3" role="group" aria-label="Basic example" style="padding-left: 20px;">
                                        <a href="#" class="open-detail btn btn-icon btn-sm btn-info" data-toggle="modal" data-id="{{ $kurban->id }}" data-target="#detailModal"><i class="fas fa-id-badge"></i> Detail</a>
                                       
                                        <a href="katalogKurban/{{$kurban->id}}/edit" class="open-edit btn btn-icon btn-sm btn-primary" ><i class="fas fa-sync"></i></i> Perbarui</a>
                                        {{-- <a href="#" class="open-delete btn btn-icon btn-sm btn-danger" data-toggle="modal" data-id="{{ $kurban->id }}" data-target="#deleteModal"><i class="fas fa-trash"></i> Hapus</a> 
                                     --}}
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
<div class="modal fade" tabindex="-1" role="dialog" id="modalTambah">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Menambahkan Data Hewan Kurban</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <form method="POST" action="{{route('tambahKurban')}}">
                            @csrf  
                        <div class="form-group">
                                <label>Jenis Kurban</label>
                                <select class="form-control" name="jenis">
                                    <option value=2>Sapi</option>
                                    <option value=1>Kambing</option>
                                </select>
                        </div>
                        <div class="form-group">
                            <label>Kategori</label>
                            <select class="form-control" name="kategori">
                                <option value="1">A</option>
                                <option value="2">B</option>
                                <option value="3">C</option>
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
                              <input type="text" class="form-control currency" name="harga">
                            </div>
                        </div>
                        <div class="form-group">
                          <label>Berat Hewan</label>
                          <div class="input-group">
                            <select name ="satuan" class="custom-select" id="inputGroupSelect05">
                              <option value="1">Gram (g)</option>
                              <option value="2">KiloGram (kg)</option>
                            </select>
                            <input name="berat" type="text" class="form-control">
                          </div>
                        </div>
                        <div class="form-group">
                            <label>Detail Hewan</label>
                            <input type="text" class="form-control" name="keterangan" placeholder="keterangan">
                        </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
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
                <img src="" id="detailFoto" class="img-thumbnail rounded mx-auto d-block" alt="foto profil" style="max-width:250px; overflow: hidden;">
                <table class="table table-borderless" style="width:90%; margin: auto;">
                    <tbody>
                        <tr>
                            <th scope="row">Nama</th>
                            <td id="detailNama"></td>
                        </tr>
                        <tr>
                            <th scope="row">Jabatan</th>
                            <td id="detailJabatan"></td>
                        </tr>
                        <tr>
                            <th scope="row">Status</th>
                            <td class="font-status" id="detailStatus"></td>
                        </tr>
                        <tr>
                            <th scope="row">Email</th>
                            <td id="detailEmail"></td>
                        </tr>
                        <tr>
                            <th scope="row">Alamat</th>
                            <td id="detailAlamat"></td>
                        </tr>
                        <tr>
                            <th scope="row">Telp/HP</th>
                            <td id="detailTelp"></td>
                        </tr>
                    </tbody>
                </table>
                <!-- <input type="text" id="id" name="id" value="" hidden/> -->
            </div>
            <div class="modal-footer bg-whitesmoke br">
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
                <h5 class="modal-title">Hapus Kurban</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img src="{{ route('home') }}/public/dist/assets/img/svg/trash.svg" id="detailFoto" class="mx-auto d-block" alt="hapus image" style="width:150px; height:150px;overflow: hidden;">

            <h5 id="pesan" align="center"></h5>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <form action="katalogKurban/delete" method="post">
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

        $('#table_id1').DataTable({
            scrollX: $scroll_table,
            pageLength: 25,
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'pdfHtml5',
                    text: '<i class="fa fa-file-pdf"></i> PDF',
                    messageTop: 'Katalog Kurban',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]
                    }
                },
                {
                    extend: 'print',
                    text: '<i class="fa fa-print"></i> Print',
                    messageTop: 'Katalog Kurban',
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
                    var select = $('<select class="form-control select" style="margin-bottom:10px;"><option value="">Jenis...</option></select>')
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
                //kriteria column 0 nama tipe select
                this.api().columns([2]).every(function() {
                    var column = this;
                    var select = $('<select class="form-control select" style="margin-bottom:10px;"><option value="">kelas...</option></select>')
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
    });
  
</script>
<script>
        $(document).on("click", ".open-delete", function() {
              /* passing data dari view button detail ke modal */
              var thisDataAnggota = $(this).data('id');
              $(".modal-footer #id_delete").val(thisDataAnggota);
              var linkDetail = "{{ route('home') }}/katalog_kurban/detail/" + thisDataAnggota;
              console.log(linkDetail);
              $.get(linkDetail, function(data) {
                  //deklarasi var obj JSON data detail anggota
                  var obj = data;
                  // ganti elemen pada dokumen html dengan hasil data json dari jquery
              document.getElementById("pesan").innerHTML = "Apakah Anda yakin ingin menghapus Kurban "+ obj.jenis+" Kategori "+obj.kelas+'?';
                
                  //base root project url + url dari db
                  // var link_foto = "{{ route('home') }}/" + obj.link_foto;
                  // document.getElementById("detailFoto").src = link_foto;
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

@include('layouts.footer')
