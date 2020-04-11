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
                <li class="breadcrumb-item active">Prediksi Kantong Kurban</li>
            </ol>
        </div>
        <div class="section-header">
            <div class="row" style="margin:auto;">
                <div class="col-12">
                    <h1><i class="fa fa-address-book"></i> Daftar Prediksi</h1>
                    <div></div>
                </div>
            </div>
        </div>
        <div class="section-body">
            {{-- <button class="btn btn-primary mt-3"  data-toggle="modal" id="togglemodal" data-target="#modalTambah">Tambah Prediksi</button> --}}
            <div class="row">
                {{-- <button style="margin: 1em auto;" class="btn btn-dark" data-toggle="collapse" data-target="#filter-box">
                    <i class="fa fa-filter"></i> Show/Close Filter Data
                </button> --}}
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
                  
                    <table id="table_id" class="table table-striped table-bordered" style="padding-bottom:20px;">
                        <thead>
                            <tr>
                                <th class="dt-center">No</th>
                                <th class="dt-center">Total Berat Daging Kurban</th>
                                <th class="dt-center">Jumlah Kantong Akan dibagikan</th>
                                <th class="dt-center">Berat Per kantong (Gram)</th>
                                {{-- <th class="dt-center">Tanggal Prediksi</th> --}}
                                <th class="dt-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                                @if(isset($prediksi))
                                @foreach ($prediksi as $item)
                            <tr>
                                <td class="dt-center">{{$loop->iteration}}</td>
                                <td>{{$TotalBerat}} Kg</td>
                                <td id="hasil"></td>
                                <td>    
                                    <div id="divsel" class="form-group">
                                        <input value="500" class="form-control" id="sel" type="number" style="margin-top:20px;" onkeyup="getSelectValue()">
                                        {{-- <select id="sel" class="form-control" name="jenis" onchange="getSelectValue()">
                                        <option value="500">500 gram</option>
                                        <option selected value="600">600 gram</option>
                                        <option value="700">700 gram</option>
                                        </select>   --}}
                                        <input id="berat" type="hidden" value="{{$TotalBerat}}">
                                    </div>
                                    
                                </td>
                                {{-- <td>{{ date('d-m-Y', strtotime($item->created_at))}}</td> --}}
                                <td class="dt-center">
                                    <div class="btn-group mb-3" role="group" aria-label="Basic example" style="padding-left: 20px;">
                                        <a href="#" class="open-detail btn btn-icon btn-sm btn-info" data-toggle="modal" data-id="" data-target="#detailModal"><i class="fas fa-id-badge"></i> Detail</a>
                                        {{-- <a href="#" class="open-edit btn btn-icon btn-sm btn-primary" data-toggle="modal" data-id="" data-target="#editModal"><i class="fas fa-sync"></i></i> Perbarui</a> --}}
                                        {{-- <a href="#" class="open-delete btn btn-icon btn-sm btn-danger" data-toggle="modal" data-id="" data-target="#deleteModal"><i class="fas fa-trash"></i> Hapus</a>  --}}
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
{{-- modal Detail --}}
<div class="modal fade" tabindex="-1" role="dialog" id="detailModal">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Detial Prediksi Kantong Kurban</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <h6>Total Jumlah Pekurban Saat ini</h6>
            <form method="POST" action="">
                            @csrf  
                        @foreach ($jumlahPekurban as $item)
                        <div class="form-group" >
                        <label> Jumlah Pekurban {{$item->jenis}} Kategori {{$item->kelas}}</label>
                        <input type="text" class="form-control" value=" {{$item->jumlahPekurban}} Orang" disabled>
                        </div>
                        @endforeach
                        @foreach ($jumlahKloterPatungan as $item)
                        <div class="form-group" >
                        <label> Jumlah Patungan Kurban </label>
                        <input type="text" class="form-control" value=" {{floor($item->jumlahPekurban/7)}} Sapi" disabled>
                        </div>
                        @endforeach
                        <div class="form-group">
                        <label>Total daging kurban (Kilogram)</label>                          
                        <input id="totalBerat" type="text" class="form-control" value="{{$TotalBerat}}" disabled>
                        <input  type="hidden" class="form-control" value="{{$TotalBerat}}" name="totalBerat" >
                        </div>
                        <div class="form-group">
                                <label>Jumlah berat per kantong</label>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <div class="input-group-text">
                                      Gram
                                     
                                        {{-- @error('berat_kantong')
                                        <div class="invalid-feedback">     
                                                {{$message}}
                                        </div>  
                                        @enderror  --}}
                                    </div>
                                    <input id="beratPerKantong" type="text" class="form-control " name="berat_kantong" disabled >
                                  </div>
                                </div>
                        </div>
                        <div class="form-group mt-3">
                                <label>Jumlah Kantong Yang akan dibagikan</label>
                                  <input id="hasilDetail" type="text" class="form-control" name="" disabled >
                        </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- modal Tambah --}}
{{-- <!-- Modal Detail -->
<div class="modal fade" tabindex="-1" role="dialog" id="detailModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Anggota</h5>
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
</div> --}}
{{-- 
<!-- Modal Delete -->
<div class="modal fade" tabindex="-1" role="dialog" id="deleteModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus Panitia</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img src="{{ route('home') }}/public/dist/assets/img/svg/trash.svg" id="detailFoto" class="mx-auto d-block" alt="hapus image" style="width:150px; height:150px;overflow: hidden;">

            <h5 id="pesan" align="center"></h5>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <form action="{{ route('hapusPanitia') }}" method="post">
                    @csrf
                   
                    <input type="text" id="id_delete" name="id" value="" hidden />
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak, Batalkan</button>
                    <input type="submit" value="Ya, Hapus" class="btn btn-danger" />
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal Edit -->
<div class="modal fade" tabindex="-1" role="dialog" id="editModal">
    <div class="modal-dialog" role="document">
        <form action="{{ route('editPanitia') }}" method="post">
            @csrf
            @method('patch')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Perbarui Data Anggota</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-borderless" style="width:90%; margin: auto;">
                        <tbody>
                            <tr>
                                <th scope="row">Nama</th>
                                <td><input name="nama" id="editNama" class="form-control" disabled /></td>
                            </tr>
                            <tr>
                                <th scope="row">Posisi</th>
                                <td>
                                        <select id="Editposisi" name="idJabatan" class="form-control" style="margin-bottom:10px; width:100%;"> 
                                            
                                               
                                                
                                                    <option  value="2">Sekretaris Panitia</option> 
                                                    <option value="3" >Peralatan</option>
                                                    <option  value="4">Humas</option>  
                                             
                                                    <option value="1" >Ketua Panitia</option>
                                                    <option value="2">Sekretaris Panitia</option> 
                                                    <option value="3" >Peralatan</option>
                                                    <option value="4">Humas</option>  
                                         
                                                
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Telp/HP</th>
                                <td><input name="telp" id="editTelp" class="form-control" disabled /></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <input type="text" id="id_edit" name="id" value="" hidden />
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
                    <input type="submit" value="Perbarui Data" class="btn btn-primary" />
                </div>
            </div>
        </form>
    </div>
</div> --}}
<!-- SCRIPT -->
<script type="text/javascript">
    //JQuery Pencarian Berdasarkan Kriteria
    // $(document).ready(function() {
    //     // $scroll_table = false;
    //     // if ($(window).width() <= 480) {
    //     //     $scroll_table = true;
    //     // }
    //     $('#table_id').DataTable({
    //         // // scrollX: $scroll_table,
    //         // pageLength: 25,
    //         // // dom: 'Bfrtip',
    //     //     buttons: [{
    //     //             extend: 'pdfHtml5',
    //     //             text: '<i class="fa fa-file-pdf"></i> PDF',
    //     //             messageTop: 'Daftar Panitia',
    //     //             exportOptions: {
    //     //                 columns: [0, 1, 2, 3, 4, 5]
    //     //             }
    //     //         },
    //     //         {
    //     //             extend: 'print',
    //     //             text: '<i class="fa fa-print"></i> Print',
    //     //             messageTop: 'Daftar Panitia',
    //     //             exportOptions: {
    //     //                 columns: [0, 1, 2, 3]
    //     //             }
    //     //         },
    //     //     ],
    //     //     lengthChange: false,
    //     //     language: {
    //     //         search: "_INPUT_",
    //     //         searchPlaceholder: "Kata Kunci Pencarian...",
    //     //         zeroRecords: "Data tidak tersedia",
    //     //         info: "Menampilkan halaman _PAGE_ dari _PAGES_",
    //     //     },
    //     //     //kriteria column 0 nama tipe input
            
    //      });
    // });

    // onclick btn delete, show modal
    $(document).on("click", ".open-delete", function() {
        /* passing data dari view button detail ke modal */
        var thisDataAnggota = $(this).data('id');
        $(".modal-footer #id_delete").val(thisDataAnggota);
        var linkDetail = "{{ route('home') }}/panitia/detail/" + thisDataAnggota;
        $.get(linkDetail, function(data) {
            //deklarasi var obj JSON data detail anggota
            var obj = data;
            // ganti elemen pada dokumen html dengan hasil data json dari jquery
        document.getElementById("pesan").innerHTML = "Apakah Anda yakin ingin menghapus panitia "+ obj.nama+'?';
          
            //base root project url + url dari db
            // var link_foto = "{{ route('home') }}/" + obj.link_foto;
            // document.getElementById("detailFoto").src = link_foto;
        });
    });
    // onclick btn edit, show modal
    $(document).on("click", ".open-edit", function() {
        /* passing data dari view button detail ke modal */
        var thisDataAnggota = $(this).data('id');
        $(".modal-footer #id_edit").val(thisDataAnggota);
        var linkDetail = "{{ route('home') }}/panitia/detail/" + thisDataAnggota;
        console.log(linkDetail);
        $.get(linkDetail, function(data) {
            //deklarasi var obj JSON data detail anggota
            var obj = data;
            var i = 1;
            opt = document.getElementById('ketua');
            // ganti elemen pada dokumen html dengan hasil data json dari jquery
            $(".modal-body #editNama").val(obj.nama);
            $(".modal-body #editTelp").val(obj.telp);
          //fungsi untuk mngecek ketua panitia hanya 1 
            if(obj.panitia_id == 1 && i == 1){
                select = document.getElementById('Editposisi');
                var opt = document.createElement('option');
                opt.value = obj.panitia_id;
                opt.innerHTML = 'Ketua Panitia' ;
                opt.id = 'ketua';
                select.appendChild(opt);
               $(".modal-body #Editposisi").val(obj.panitia_id);
                i++;
            }else if(obj.panitia_id != 1 ) {
              
               if(opt!=null){
                opt.remove();
                }
                $(".modal-body #Editposisi").val(obj.panitia_id);
            }
          
            //base root project url + url dari db
            // var link_foto = "{{ route('home') }}/" + obj.link_foto;
            // document.getElementById("detailFoto").src = link_foto;
        });
    });
    // onclick btn detail, show modal
    $(document).on("click", ".open-detail", function() {
        console.log('COBA');
        var beratTabel = document.getElementById('sel');
        var beratDetail= document.getElementById('beratPerKantong');
        var hasilTabel = document.getElementById('hasil');
        var hasilDetail = document.getElementById('hasilDetail');

        beratDetail.value = beratTabel.value;
        hasilDetail.value =hasilTabel.innerHTML;
    });
</script>
<script>
 function hitungPrediksi(){
          var inputan = document.getElementById("beratPerKantong").value;
           var inputanTotalBerat= document.getElementById("totalBerat").value; 

          var hasil = (inputanTotalBerat*1000)/inputan;
          document.getElementById("hasil").value = Math.ceil(hasil);
          document.getElementById("hasil2").value = Math.ceil(hasil);
        //   document.getElementById("outputharga2").value =selectedValue.replace(/,/g, '');; 
          
       
        
        }
    
</script>
  <script>
        function getSelectValue(){
           var inputan = document.getElementById("sel").value;
           var inputanTotalBerat= document.getElementById("berat").value; 

          var hasil = (inputanTotalBerat*1000)/inputan;
          document.getElementById("hasil").innerHTML = Math.ceil(hasil) + " Kantong";
          //ceil pembultan keatas
        //   document.getElementById("hasil2").value = Math.ceil(hasil);
        
        }
        getSelectValue();
</script>

@include('layouts.footer')