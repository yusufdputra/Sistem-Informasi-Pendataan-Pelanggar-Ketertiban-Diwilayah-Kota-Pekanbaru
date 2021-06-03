@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card-box table-responsive">

      @role('admin')
      <div class="form-row">
        <div class="form-group ">
          <a href="#perda-edit-modal" data-animation="sign" data-plugin="custommodal" data-overlaySpeed="100" data-overlayColor="#36404a" class="btn btn-purple m-l-10 waves-light ">Ubah</a>
          <a href="{{route('perda.index')}}" class="btn btn-success m-l-10 waves-light  ">Selesai</a>
        </div>



      </div>
      @endrole



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
            <th>Nomor Perda</th>
            <th>Nama Perda</th>
            <th>Pelanggaran
              <a href="#pelanggaran-tambah-modal" data-animation="sign" data-plugin="custommodal" data-overlaySpeed="100" data-overlayColor="#36404a" class="btn btn-success btn-rounded btn-sm"><i class="fa fa-plus"></i></a>
            </th>
            <th>Jenis Sangsi
              <a href="#sangsi-tambah-modal" data-animation="sign" data-plugin="custommodal" data-overlaySpeed="100" data-overlayColor="#36404a" class="btn btn-success btn-rounded btn-sm"><i class="fa fa-plus"></i></a>
            </th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>{{$perda->nomor_perda}}</td>
            <td>{{$perda->nama_perda}}</td>
            <td>
              <ol type="a">
                @foreach ($pelanggarans as $key => $value)
                <li>{{$value->nama}}
                  <a href="#edit-modal" data-animation="sign" data-plugin="custommodal" data-nama='{{$value->nama}}' data-id='{{$value->id}}' data-overlaySpeed="100" data-overlayColor="#36404a" class="btn btn-rounded btn-primary btn-sm edit_pelanggaran ml-3"><i class="fa fa-edit"></i></a>
                  <a href="#hapus-modal" data-animation="sign" data-plugin="custommodal" data-id='{{$value->id}}' data-overlaySpeed="100" data-overlayColor="#36404a" class="btn btn-rounded btn-danger btn-sm hapus_pelanggaran "><i class="fa fa-trash"></i></a>
                </li>

                @endforeach
              </ol>
            </td>
            <td>
              <ol type="a">
                @foreach ($jenis_sangsi as $key => $value)
                <li>{{$value->nama}}
                  <a href="#edit-modal" data-animation="sign" data-plugin="custommodal" data-nama='{{$value->nama}}' data-id='{{$value->id}}' data-overlaySpeed="100" data-overlayColor="#36404a" class="btn btn-rounded btn-primary btn-sm edit_sangsi ml-3"><i class="fa fa-edit"></i></a>
                  <a href="#hapus-modal" data-animation="sign" data-plugin="custommodal" data-id='{{$value->id}}' data-overlaySpeed="100" data-overlayColor="#36404a" class="btn btn-rounded btn-danger btn-sm hapus_sangsi "><i class="fa fa-trash"></i></a>
                </li>

                @endforeach
              </ol>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
<!-- end row -->
<div id="perda-edit-modal" class="modal-demo">
  <button type="button" class="close" onclick="Custombox.close();">
    <span>&times;</span><span class="sr-only">Close</span>
  </button>

  <div class="custom-modal-text">

    <div class="text-center">
      <h4 class="text-uppercase font-bold mb-0">Ubah Pelanggaran Peraturan Daerah</h4>
    </div>
    <div class="p-20 text-left">
      <form class="form-horizontal m-t-20" enctype="multipart/form-data" action="{{route('perda.update')}}" method="POST">
        {{csrf_field()}}  

        <input type="hidden" name="id" value="{{$perda->id}}" id="">
        <div class="form-group">
          <label>Nomor Perda</label>
          <div class="col-xs-12">
            <input class="form-control" type="text" autocomplete="off" name="nomor" value="{{$perda->nomor_perda}}" required="" placeholder="Nomor Perda">
          </div>
        </div>

        <div class="form-group">
          <label>Nama Perda</label>
          <div class="col-xs-12">
            <input class="form-control" type="text" autocomplete="off" name="nama" value="{{$perda->nama_perda}}" required="" placeholder="Nama Perda">
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

<div id="pelanggaran-tambah-modal" class="modal-demo">
  <button type="button" class="close" onclick="Custombox.close();">
    <span>&times;</span><span class="sr-only">Close</span>
  </button>

  <div class="custom-modal-text">

    <div class="text-center">
      <h4 class="text-uppercase font-bold mb-0">Tambah Pelanggaran Peraturan Daerah</h4>
    </div>
    <div class="p-20 text-left">
      <form class="form-horizontal m-t-20" enctype="multipart/form-data" action="{{route('PerdaPelanggaran.store')}}" method="POST">
        {{csrf_field()}}

        <input type="hidden" name="id" value="{{$perda->id}}" id="">
        <div class="form-group">
          <label>Nama Pelanggaran</label>
          <div class="col-xs-12">
            <input class="form-control" type="text" autocomplete="off" name="nama" required="" placeholder="Nama Perda">
          </div>
        </div>

        <div class="form-group text-center m-t-30">
          <div class="col-xs-12">
            <button class="btn btn-success btn-bordred btn-block waves-effect waves-light" type="submit">Tambah</button>
          </div>
        </div>


      </form>

    </div>
  </div>

</div>

<div id="sangsi-tambah-modal" class="modal-demo">
  <button type="button" class="close" onclick="Custombox.close();">
    <span>&times;</span><span class="sr-only">Close</span>
  </button>

  <div class="custom-modal-text">

    <div class="text-center">
      <h4 class="text-uppercase font-bold mb-0">Tambah Sangsi Pelanggaran Peraturan Daerah</h4>
    </div>
    <div class="p-20 text-left">
      <form class="form-horizontal m-t-20" enctype="multipart/form-data" action="{{route('sangsi.store')}}" method="POST">
        {{csrf_field()}}

        <input type="hidden" name="id" value="{{$perda->id}}" id="">
        <div class="form-group">
          <label>Nama Pelanggaran</label>
          <div class="col-xs-12">
            <input class="form-control" type="text" autocomplete="off" name="nama" required="" placeholder="Nama Perda">
          </div>
        </div>

        <div class="form-group text-center m-t-30">
          <div class="col-xs-12">
            <button class="btn btn-success btn-bordred btn-block waves-effect waves-light" type="submit">Tambah</button>
          </div>
        </div>


      </form>

    </div>
  </div>

</div>

<div id="edit-modal" class="modal-demo">
  <button type="button" class="close" onclick="Custombox.close();">
    <span>&times;</span><span class="sr-only">Close</span>
  </button>

  <div class="custom-modal-text">

    <div class="text-center">
      <h4 class="text-uppercase font-bold mb-0">Edit </h4>
    </div>
    <div class="p-20 text-left">

      <form class="form-horizontal m-t-20" id="form-edit" enctype="multipart/form-data" method="POST">
        {{csrf_field()}}
        <input type="hidden" name="id" id="edit_id">
        <input type="hidden" name="id_perda" value="{{$perda->id}}" id="">
        <div class="form-group">
          <label>Nama</label>
          <div class="col-xs-12">
            <input class="form-control" type="text" autocomplete="off" id="edit_nama" name="nama" required="" placeholder="Input Dengan Benar">
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

<div id="hapus-modal" class="modal-demo">
  <button type="button" class="close" onclick="Custombox.close();">
    <span>&times;</span><span class="sr-only">Close</span>
  </button>

  <div class="custom-modal-text">

    <div class="text-center">
      <h4 class="text-uppercase font-bold mb-0">Apakah anda yakin?</h4>
    </div>
    <div class="p-20">
      <form class="form-horizontal m-t-20" id="form-hapus" enctype="multipart/form-data" method="POST">
        {{csrf_field()}}
        <div>
          <input type="hidden" id='id_hapus' name='hapusId'>
          <input type="hidden" id='perdaId' value="{{$perda->id}}" name='perdaId'>
        </div>

        <div class="modal-footer">
          <button type="button" onclick="Custombox.close();" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary waves-effect waves-light">Yakin</button>
        </div>


      </form>

    </div>
  </div>

</div>


<script type="text/javascript">
  // kelola pelanggaran
  $('.edit_pelanggaran').click(function() {
    var id = $(this).data('id');
    var nama = $(this).data('nama');
    $('#edit_id').val(id)
    $('#edit_nama').val(nama)
    $('#form-edit').attr('action', "{{route('PerdaPelanggaran.edit')}}");

  });

  $('.hapus_pelanggaran').click(function() {
    var id = $(this).data('id');
    $('#id_hapus').val(id);
    $('#form-hapus').attr('action', "{{route('PerdaPelanggaran.hapus')}}");

  });

  // kelola sangsi
  $('.edit_sangsi').click(function() {
    var id = $(this).data('id');
    var nama = $(this).data('nama');
    $('#edit_id').val(id)
    $('#edit_nama').val(nama)
    $('#form-edit').attr('action', "{{route('sangsi.edit')}}");

  });

  $('.hapus_sangsi').click(function() {
    var id = $(this).data('id');
    $('#id_hapus').val(id);
    $('#form-hapus').attr('action', "{{route('sangsi.hapus')}}");

  });
</script>


@endsection