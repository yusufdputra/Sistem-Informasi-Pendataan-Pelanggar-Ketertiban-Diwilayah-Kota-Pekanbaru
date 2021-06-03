<div class="left side-menu">
  <div class="sidebar-inner slimscrollleft">

    <!-- User -->
    <div class="user-box">
      <a href="#edit-password" data-animation="sign" data-plugin="custommodal"  data-overlaySpeed="100" data-overlayColor="#36404a">
      <div class="user-img">
        <img src="{{asset('adminto/images/users/profile.png')}}" alt="user-img" title="Mat Helme" class="rounded-circle img-thumbnail img-responsive">
        <div class="user-status online"><i class="mdi mdi-adjust"></i></div>
      </div>
      </a>
     
      <h5 ><a href="#edit-password" data-animation="sign" data-plugin="custommodal"  data-overlaySpeed="100" data-overlayColor="#36404a"> {{ Auth::user()->nama }}</a> </h5>
      <ul class="list-inline">


        <li class="list-inline-item">
          <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
            {{ __('Keluar') }}
          </a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
          </form>
        </li>
      </ul>
    </div>
    <!-- End User -->

    <!--- Sidemenu -->
    <div id="sidebar-menu">
      <ul>
        <li class="text-muted menu-title">Navigasi</li>
        <li>
          <a href="{{('/')}}" class="waves-effect"><i class="mdi mdi-view-dashboard"></i> <span> Halaman Utama </span> </a>
        </li>
        @role('admin')

        <li class="has_sub">
          <a href="javascript:void(0);" class="waves-effect"><i class=" mdi mdi-account-multiple"></i> <span> Data Pengguna </span> <span class="fa menu-arrow"></span></a>
          <ul class=" list-unstyled">
            <li><a href="{{route ('user.index', 'pimpinan')}}">Pimpinan</a></li>
            <li><a href="{{route ('user.index', 'petugas')}}">Petugas</a></li>
          </ul>
        </li>

        <li>
          <a href="{{route ('perda.index')}}" class="waves-effect"><i class="fa fa-balance-scale"></i> <span> PerDa </span> </a>
        </li>

        @endrole


        @role('admin|petugas|pimpinan')
        
        <li>
          <a href="{{route ('pelanggaran.index')}}" class="waves-effect"><i class="mdi mdi-radioactive"></i> <span> Pelanggaran </span> </a>
        </li>

        @endrole






      </ul>
      <div class="clearfix"></div>
    </div>
    <!-- Sidebar -->
    <div class="clearfix"></div>

  </div>

</div>
<!-- Left Sidebar End -->

<div id="edit-password" class="modal-demo">
  <button type="button" class="close" onclick="Custombox.close();">
    <span>&times;</span><span class="sr-only">Close</span>
  </button>

  <div class="custom-modal-text text-left">

    <div class="text-center">
      <h4 class="text-uppercase font-bold mb-0">Ubah Kata Sandi</h4>
    </div>
    <div class="p-20">

      <form class="form-horizontal m-t-20" action="{{route('user.resetpw')}}" method="POST">
        {{csrf_field()}}

        <div class="form-group">
          <label for="">Kata Sandi Baru</label>
          <div class="col-xs-12">
            <input class="form-control" type="text" autocomplete="off" name="password" required="" placeholder="Masukkan Kata Sandi Baru">
          </div>
        </div>


        <div class="form-group text-center m-t-30">
          <div class="col-xs-12">
            <button class="btn btn-success btn-bordred btn-block waves-effect waves-light" type="submit">Ubah</button>
          </div>
        </div>


      </form>

    </div>
  </div>

</div>

<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="content-page">
  <!-- Start content -->
  <div class="content">
    <div class="container-fluid">


    </div> <!-- container -->

  </div> <!-- content -->

  <footer class="footer text-right">
    2021 - Satpol PP Kota Pekanbaru
  </footer>

</div>