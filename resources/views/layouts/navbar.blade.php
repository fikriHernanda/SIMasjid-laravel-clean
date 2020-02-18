<body>

  <?php
  /* PHP UNTUK PENGATURAN VIEW */
  //anggota terautentikasi
  $authUser = Auth::user();
  //hide untuk selain sekretaris dan ketua
  $sekretaris = array(1, 2);
  $inside_sekretaris = in_array($authUser->id_jabatan, $sekretaris);

  //pengaturan notifikasi
  use App\Models\Notifikasi;
  use Illuminate\Support\Facades\Auth;

  $notifs = Notifikasi::where('id_penerima', '=', Auth::user()->id)->skip(0)->take(5)->orderBy('id', 'desc')->get();
  ?>

  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <div class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
          </ul>
        </div>
        <ul class="navbar-nav navbar-right">
          <!-- <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link nav-link-lg message-toggle"><i class="fas fa-tasks"></i></a></li> -->
          <?php
          //belum baca 0
          $array_sudah_baca = [];
          foreach ($notifs as $notif) {
            //jumlah belum baca ditambah jumlah sudah baca dari db
            $sudah_baca = $notif->sudah_baca;
            array_push($array_sudah_baca, $sudah_baca);
          }
          $not_read_yet = in_array(0,  $array_sudah_baca); //jika masih ada berarti ada yg blm dibaca
          ?>
          @if ( $not_read_yet == true )
          <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg beep"><i class="far fa-bell"></i></a>
            @else
          <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg"><i class="far fa-bell"></i></a>
            @endif
            <div class="dropdown-menu dropdown-list dropdown-menu-right">
              <div class="dropdown-header">Notifications
                <div class="float-right">
                  <a href="#">Mark All As Read</a>
                </div>
              </div>
              <div class="dropdown-list-content dropdown-list-icons">
                @foreach ( $notifs as $notif )
                @if ( $notif->sudah_baca == 0 )
                <a href="#" class="notif dropdown-item dropdown-item-unread" data-id="{{ $notif->id }}">
                  @else
                  <a href="{{ $notif->link }}" class="dropdown-item">
                    @endif
                    <div class="dropdown-item-icon {{ $notif->bg }} text-white">
                      <i class="{{ $notif->icon }}"></i>
                    </div>
                    <div class="dropdown-item-desc">
                      <strong>{{ $notif->jenis }}</strong>
                      </br>
                      <?php
                      if (isset($notif->id_pembuat)) {
                        echo $notif->pembuat->nama . ' ' . $notif->msg;
                      } else {
                        echo 'SYSTEM' . ' ' . $notif->msg;
                      }
                      ?>
                      <div class="time text-primary">{{ $notif->tgl_dibuat->diffForHumans() }}</div>
                    </div>
                  </a>
                  @endforeach
              </div>
              <div class="dropdown-footer text-center">
                <a href="#">View All <i class="fas fa-chevron-right"></i></a>
              </div>
            </div>
          </li>
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
              <img alt="image" src="
              <?php
              if ($authUser->link_foto != null) {
                echo route('home').'/'.$authUser->link_foto.'?='.filemtime($authUser->link_foto);
              } else {
                echo route('home').'/'.'public\dist\assets\img\avatar\avatar-1.png';
              }
              ?>" class="rounded-circle mr-1">
              <div class="d-sm-none d-lg-inline-block"> {{$authUser->nama}}</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <a href="{{ route('profile') }}" class="dropdown-item has-icon">
                <i class="far fa-user"></i> Profile
              </a>
              <a href="{{ route('pengaturanAkun') }}" class="dropdown-item has-icon">
                <i class="fas fa-cog"></i> Pengaturan Akun
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item has-icon text-danger" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="{{ route('home') }}">SI MASJID IBNU SINA</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('home') }}">SIM</a>
          </div>
          <ul class="sidebar-menu">
            <li id='home-link'><a class="nav-link" href="{{ route('home') }}"><i class="fas fa-mosque"></i><span>Home</span></a></li>
            <li id='keanggotaan-link'><a class="nav-link" href="{{ route('anggotaIndex') }}"><i class="fas fa-users"></i><span>Keanggotaan</span></a></li>
            <li id='aset-link'><a class="nav-link not-ready" href="#"><i class="fas fa-warehouse"></i><span>Aset</span></a></li>
            <li id='keuangan-link'><a class="nav-link not-ready" href="#"><i class="fas fa-money-bill-wave"></i><span>Keuangan</span></a></li>
            <li id='musyawarah-link'><a class="nav-link not-ready" href="#"><i class="fas fa-comments"></i><span>Musyawarah</span></a></li>
            <li id='link-drop-aset' class="nav-item dropdown">
              <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="icofont-cow icofont-2x"></i><span>Kurban</span></a>
              <ul class="dropdown-menu">

              <li id='link-master-aset'><a class="nav-link" href="{{route('manajPanitia')}}"><i class="icofont-group"></i>Daftar Panitia</a></li>
              
              <li><a class="nav-link" href="">Pekerjaan</a></li>
              <li><a class="nav-link" href="">Penerima Kurban </a></li>
              <li><a class="nav-link" href="">Persiapan</a></li>
              <li><a class="nav-link" href="{{route('manajKurban')}}"><img src="{{URL::asset('/public/dist/navbarkurban/cow-silhouette.png')}}" alt="profile Pic" height="15px" width="15px" style="margin:0px 5px">Katalog Hewan</a></li>
              <li><a class="nav-link" href="">Keuangan</a></li>
              <li><a class="nav-link" href="{{route('manajPekurban')}}"><img src="{{URL::asset('/public/dist/navbarkurban/shopping-list.png')}}" alt="profile Pic" height="15px" width="15px" style="margin:0px 5px">Pendaftaran</a></li>
              <li><a class="nav-link" href="#">Pemotongan</a></li>
              <li><a class="nav-link" href="#">Distribusi</a></li>
              </ul>
            </li>
            

        </aside>
      </div>
      <script>
        $(document).ready(function() {
          $("body").addClass("sidebar-mini");
          $('.not-ready').click(function() {
            alert('Fitur ini belum tersedia');
          });
        });

        $('.notif').click(function() {
          var id = $(this).data('id');
          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
          $.ajax({
            url: "{{ route('notifReadJSON') }}",
            data: {
              id: id
            },
            type: 'POST',
            success: function(data) {
              console.log(data.success);
            }
          });
        });
      </script>