@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card-box table-responsive">
      <div class="form-row">
        @role('petugas')
        <div class="form-group ">
          <a href="{{route('pelanggaran.baru')}}" class="btn btn-primary m-l-10 waves-light  ">Tambah</a>
        </div>

        @endrole

        @role('admin|pimpinan')

        <div class="form-group ">
          <a href="#cetak-modal" data-animation="sign" data-plugin="custommodal" data-overlaySpeed="100" data-overlayColor="#36404a" class="btn btn-secondary m-l-10 waves-light  ">Cetak</a>
        </div>
        @endrole
      </div>
      @if(\Session::has('alert'))
      <div class="alert alert-danger">
        <div>{{Session::get('alert')}}</div>
      </div>
      @endif

      @if(\Session::has('success'))
      <div class="alert alert-success">
        <div>{{Session::get('success')}}</div>
      </div>
      @endif

      <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th>No</th>
            <th>Nomor KTP</th>
            <th>Nama Lengkap</th>
            <th>TTL</th>
            <th>Jenis Kelamin</th>
            <th>Agama</th>
            <th>Pekerjaan</th>
            <th>Alamat</th>
            <th>Nomor Hp</th>
            <th>Pelanggaran</th>
            <th>Waktu</th>
            <th>Lokasi</th>
            <th>Keterangan</th>
            <th>Foto KTP</th>
            @role('admin|petugas')
            <th>Aksi</th>
            @endrole
          </tr>
        </thead>

        <tbody>

          @foreach ($pelanggaran as $key=>$value)
          <tr>
            <td>{{$key+1}}</td>
            <td>{{$value->no_ktp}}</td>
            <td>{{$value->nama}}</td>
            <td>{{$value->ttl}}</td>
            <td>
              @if($value->jns_kelamin == 'lk')
              Laki-Laki
              @else
              Perempuan
              @endif
            </td>
            <td>{{$value->agama}}</td>
            <td>{{$value->pekerjaan}}</td>
            <td>{{$value->alamat}}</td>
            <td>{{$value->nomor_hp}}</td>
            <td>{{$value->perda[0]['nama_perda']}} - {{$value->pelanggaran}}</td>
            <td>{{date("d-M-Y H:i ", strtotime(($value->created_at)))}} WIB</td>
            <td>{{$value->lokasi}}</td>
            <td>{{$value->keterangan}}</td>
            <td>
              <a href="#view-image-modal" data-animation="sign" data-plugin="custommodal" data-path='{{$value->ktp_path}}' data-overlaySpeed="100" data-overlayColor="#36404a" class="btn btn-primary btn-sm view_image"><i class=" mdi mdi-eye"></i></a>
            </td>

            @role('admin|petugas')
            @if (($value->status) == 0)
            <td>
              @role('admin')
              <a href="{{route('pelanggaran.terima', $value->id)}}" class="btn  btn-success btn-sm"><i class="mdi mdi-check"></i></a>
              @else
              <div class="row">
                <a href="{{route('pelanggaran.edit', $value->id)}}" class="btn  btn-success btn-sm"><i class="fa fa-edit"></i></a>

                <a href="#hapus-modal" data-animation="sign" data-plugin="custommodal" data-id='{{$value->id}}' data-overlaySpeed="100" data-overlayColor="#36404a" class="btn  btn-danger btn-sm hapus"><i class="fa fa-trash"></i></a>
              </div>
              @endrole
            </td>
            @else
            <td>Sudah Diterima</td>
            @endif
            @endrole

          </tr>
          @endforeach

        </tbody>
      </table>
    </div>
  </div>
</div>
<!-- end row -->

<div id="view-image-modal" class="modal-demo">
  <button type="button" class="close" onclick="Custombox.close();">
    <span>&times;</span><span class="sr-only">Close</span>
  </button>

  <div class="custom-modal-text">

    <div class="text-center">
      <h4 class="text-uppercase font-bold mb-0">Foto KTP Pelanggar</h4>
    </div>
    <div class="p-20 ">

      <div class="m-b-20" id="">
        <div class="load">
        </div>

        <div class="m-b-20" id="img_view">
        </div>
      </div>
    </div>
  </div>

</div>

<div id="hapus-modal" class="modal-demo">
  <button type="button" class="close" onclick="Custombox.close();">
    <span>&times;</span><span class="sr-only">Close</span>
  </button>

  <div class="custom-modal-text">

    <div class="text-center">
      <h4 class="text-uppercase font-bold mb-0">Hapus Pelanggaran Ini</h4>
    </div>
    <div class="p-20">

      <form class="form-horizontal m-t-20" enctype="multipart/form-data" action="{{route('pelanggaran.hapus')}}" method="POST">
        {{csrf_field()}}
        <div>
          <input type="hidden" id='id_hapus' name='id'>
          <h5 id="exampleModalLabel">Apakah anda yakin ingin mengapus Pelanggaran Ini?</h5>
        </div>

        <div class="form-group text-center m-t-30">
          <div class="col-xs-6">
            <button type="button" onclick="Custombox.close();" class="   btn btn-primary btn-bordred btn-block waves-effect waves-light">Tidak</button>
            <button class="btn btn-danger btn-bordred btn-block waves-effect waves-light" type="submit">Hapus</button>
          </div>
        </div>


      </form>

    </div>
  </div>

</div>

<div id="cetak-modal" class="modal-demo">
  <button type="button" class="close" onclick="Custombox.close();">
    <span>&times;</span><span class="sr-only">Close</span>
  </button>

  <div class="custom-modal-text">

    <div class="text-center">
      <h4 class="text-uppercase font-bold mb-0">Cetak Laporan</h4>
    </div>
    <div class="p-20 text-left">
      <form class="form-horizontal m-t-20" target="_BLANK" enctype="multipart/form-data" action="{{route('cetak')}}" method="POST">
        {{csrf_field()}}

        <input type="hidden" value="keluar" name="jenis">

        <div class="form-group">
          <label for="">Dari Tanggal</label>
          <div class="col-xs-12">
            <div class="input-group-append">
              <input type="text" id="startdate" class="form-control datepicker-autoclose" placeholder="dd/mm/yyyy"  autocomplete="off"  name="start_date" id="">
              <span class="input-group-text"><i class="ti-calendar"></i></span>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label for="">Sampai Tanggal</label>
          <div class="col-xs-12">
            <div class="input-group-append">
              <input type="text" id="enddate" class="form-control datepicker-autoclose" placeholder="dd/mm/yyyy"  autocomplete="off" name="end_date"  id="">
              <span class="input-group-text"><i class="ti-calendar"></i></span>
            </div>
          </div>
        </div>


        <div class="form-group text-center m-t-30">
          <div class="col-xs-12">
            <button class="btn btn-success btn-bordred btn-block waves-effect waves-light" type="submit">Cetak</button>
          </div>
        </div>


      </form>

    </div>
  </div>

</div>

<script type="text/javascript">
  $('.view_image').click(function() {
    $('#img_view').html('')
    var foto_path = $(this).data('path');

    $('#load').append('<i class="fa fa-spin fa-circle-o-notch"></i>')
    $('#img_view').append('<img src="storage/' + foto_path + '"  class="m-b-20 thumb-img" alt="work-thumbnail">')
    $('#load').html('')
  });

  $('.hapus').click(function() {
    var id = $(this).data('id');
    $('#id_hapus').val(id);
  });
</script>


@endsection