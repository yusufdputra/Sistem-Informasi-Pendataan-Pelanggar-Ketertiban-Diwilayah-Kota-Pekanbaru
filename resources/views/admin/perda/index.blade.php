@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card-box table-responsive">

      @role('admin')
      <div class="form-row">
        <div class="form-group ">
          <a href="#tambah-modal" data-animation="sign" data-plugin="custommodal" data-overlaySpeed="100" data-overlayColor="#36404a" class="btn btn-primary m-l-10 waves-light  ">Tambah</a>
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
            <th>No.</th>
            <th>Nomor Perda</th>
            <th>Nama Perda</th>
            <th>Pelanggaran</th>
            <th>Sangsi</th>
            <th>Tanggal Perubahan</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          
          @foreach ($perda AS $key=>$value)
          <tr>
            <td>{{$key+1}}</td>
            <td>{{$value->nomor_perda}}</td>
            <td>{{$value->nama_perda}}</td>

            <td>
              @if(($pelanggarans[$key]) != null)
              <ol type="a">
                @foreach ($pelanggarans[$key] AS $k=>$v)
                <li>{{$v}}</li>
                @endforeach
              </ol>
              @else
              Tidak Ditemukan
              @endif
            </td>

            <td>
              @if(($sangsis[$key]) != null)
              <ol type="a">
                @foreach ($sangsis[$key] AS $k=>$v)
                <li>{{$v}}</li>
                @endforeach
              </ol>
              @else
              Tidak Ditemukan
              @endif
            </td>

            <td>

              @if($value['updated_at'] != null)
              {{date('d-M-Y, H:m', strtotime($value['updated_at']))}} WIB
              @else
              {{date('d-M-Y, H:m', strtotime($value['created_at']))}} WIB
              @endif
            </td>

            @role('admin')
            <td >
              <a href="{{route('perda.edit', $value->id)}}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
              <a href="#hapus-modal" data-animation="sign" data-plugin="custommodal" data-id='{{$value->id}}' data-overlaySpeed="100" data-overlayColor="#36404a" class="btn btn-danger btn-sm hapus"><i class="fa fa-trash"></i></a>
            </td>
            @endrole
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- end row -->
<div id="tambah-modal" class="modal-demo">
  <button type="button" class="close" onclick="Custombox.close();">
    <span>&times;</span><span class="sr-only">Close</span>
  </button>

  <div class="custom-modal-text">

    <div class="text-center">
      <h4 class="text-uppercase font-bold mb-0">Tambah Peraturan Daerah</h4>
    </div>
    <div class="p-20 text-left">
      <form class="form-horizontal m-t-20" enctype="multipart/form-data" action="{{route('perda.store')}}" method="POST">
        {{csrf_field()}}

        <div class="form-group">
          <label>Nomor Peraturan</label>
          <div class="col-xs-12">
            <input class="form-control" type="text" autocomplete="off" name="nomor" required="" placeholder="Nomor Perda">
          </div>
        </div>
        <div class="form-group">
          <label>Nama Peraturan</label>
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


<div id="hapus-modal" class="modal-demo">
  <button type="button" class="close" onclick="Custombox.close();">
    <span>&times;</span><span class="sr-only">Close</span>
  </button>

  <div class="custom-modal-text">

    <div class="text-center">
      <h4 class="text-uppercase font-bold mb-0">Hapus Perda</h4>
    </div>
    <div class="p-20">

      <form class="form-horizontal m-t-20" enctype="multipart/form-data" action="{{route('perda.hapus')}}" method="POST">
        {{csrf_field()}}
        <div>
          <input type="hidden" id='id_hapus' name='id'>
          <h5 id="exampleModalLabel">Apakah anda yakin ingin mengapus perda ini?</h5>
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


<script type="text/javascript">
  $('.modal_edit').click(function() {
    var id = $(this).data('id');
    $('#edit_id').val(id)

    $.ajax({
      url: '{{url("barang/edit")}}/' + id,
      type: 'GET',
      dataType: 'json',
      success: 'success',
      success: function(data) {
        $('#edit_id').val(id)
        $('#edit_nama').val(data['nama'])
        $('#edit_stok').val(data['stok'])
        $('#edit_satuan').val(data['satuan'])

      },
      error: function(data) {
        toastr.error('Gagal memanggil data! ')
      }
    })

  });


  $('.hapus').click(function() {
    var id = $(this).data('id');
    $('#id_hapus').val(id);
  });
</script>


@endsection