@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card-box">


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

      <form class="form-horizontal m-t-20" enctype="multipart/form-data" action="{{route('restok.store')}}" method="POST">
        {{csrf_field()}}

        <div class="col-lg-12 col-xs-12 row">
          <div class="col-lg-6 col-xs-12">
            <div class="form-group">
              <label for="">Nomor KTP</label>
              <div class="col-xs-12">
                <div class="input-group-append">
                  <input class="form-control" id="no_ktp" type="text" autocomplete="off" name="no_ktp" required="" placeholder="Nomor KTP">
                  <a href="#" class="cariKtp"><span class="input-group-text btn-success"><i class="mdi mdi-account-search"></i></span></a>

                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-6 col-xs-12">
            <div class="form-group">
              <label for="">Nama Lengkap</label>
              <div class="col-xs-12">
                <input class="form-control" type="text" autocomplete="off" name="nama" required="" placeholder="Nama Pelanggar">
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-12 col-xs-12 row">
          <div class="col-lg-6 col-xs-12">
            <div class="form-group">
              <label for="">Tempat Lahir</label>
              <div class="col-xs-12">
                <input class="form-control" type="text" autocomplete="off" name="tempat_lahir" required="" placeholder="Sesuai KTP">
              </div>
            </div>
          </div>

          <div class="col-lg-6 col-xs-12">
            <div class="form-group">
              <label for="">Tanggal Lahir</label>
              <div class="col-xs-12">
                <input class="form-control datepicker-autoclose" type="text" autocomplete="off" name="tgl_lahir" required="" placeholder="dd/mm/yyyy">
              </div>
            </div>
          </div>

        </div>

        <div class="col-lg-12 col-xs-12 row">
          <div class="col-lg-6 col-xs-12">
            <div class="form-group">
              <label for="">Jenis Kelamin</label>
              <div class="col-xs-12">
                <select required class="form-control" name="jns_kelamin">
                  <option value="lk">Laki-Laki</option>
                  <option value="lk">Perempuan</option>
                </select>
              </div>
            </div>
          </div>

          <div class="col-lg-6 col-xs-12">
            <div class="form-group">
              <label for="">Agama</label>
              <div class="col-xs-12">
                <select required class="form-control" name="agama">
                  <option value="Islam">Islam</option>
                  <option value="Protestan">Protestan</option>
                  <option value="Katolik">Katolik</option>
                  <option value="Hindu">Hindu</option>
                  <option value="Buddha">Buddha</option>
                  <option value="Khonghucu">Khonghucu</option>
                </select>
              </div>
            </div>
          </div>

        </div>

        <div class="col-lg-12 col-xs-12 row">
          <div class="col-lg-6 col-xs-12">
            <div class="form-group">
              <label for="">Pekerjaan</label>
              <div class="col-xs-12">
                <input class="form-control" type="text" autocomplete="off" name="pekerjaan" required="" placeholder="Pekerjaan">
              </div>
            </div>
          </div>

          <div class="col-lg-6 col-xs-12">
            <div class="form-group">
              <label for="">Alamat</label>
              <div class="col-xs-12">
                <textarea class="form-control" type="text" autocomplete="off" name="lokasi" placeholder="Alamat Sesuai KTP" required=""></textarea>

              </div>
            </div>
          </div>

        </div>

        <div class="col-lg-12 col-xs-12 row">
          <div class="col-lg-6 col-xs-12">
            <div class="form-group">
              <label for="">Jenis Pelanggaran</label>
              <div class="col-xs-12">
                <select required class="form-control" name="jns_kelamin">
                  <option value="Pedagang kaki lima">Pedagang kaki lima</option>
                  <option value="Hiburan umum">Hiburan umum</option>
                  <option value="Protokol Kesehatan">Protokol Kesehatan</option>
                </select>
              </div>
              <span class="help-block"><small>A block of help text that breaks onto a new line and may extend beyond one line.</small></span>
            </div>
          </div>

          <div class="col-lg-6 col-xs-12">
            <div class="form-group">
              <label for="">Nomor Hp</label>
              <div class="col-xs-12">
                <input class="form-control" type="text" autocomplete="off" name="no_hp" required="" placeholder="Nomor Hp">
              </div>
            </div>
          </div>

        </div>

        <div class="col-lg-12 col-xs-12 row">
          <div class="col-lg-6 col-xs-12">
            <div class="form-group">
              <label for="">Lokasi Pelanggaran</label>
              <div class="col-xs-12">
                <textarea class="form-control" type="text" autocomplete="off" name="lokasi" placeholder="Lokasi Pelanggaran" required=""></textarea>
              </div>
            </div>
          </div>

          <div class="col-lg-6 col-xs-12">
            <div class="form-group">
              <label for="">Keterangan</label>
              <div class="col-xs-12">
                <textarea class="form-control" type="text" autocomplete="off" name="lokasi" placeholder="Keterangan Pelanggaran" required=""></textarea>
              </div>
            </div>
          </div>

        </div>


        <div class="col-lg-12 col-xs-12">
          <div class="form-group">
            <label for="">Foto KTP</label>
            <div class="col-xs-12">
              <input type="file" name="foto_ktp" class="dropify" data-max-file-size="5M" />
            </div>
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
<!-- end row -->

<script type="text/javascript">


  $('.cariKtp').click(function() {
    // var id = $(this).data('no_ktp');
    var no_ktp = document.getElementById('no_ktp').value
    console.log(no_ktp);
    // $('#edit_id').val(id)

    // $.ajax({
    //   url: '{{url("restosk/edit")}}/' + id,
    //   type: 'GET',
    //   dataType: 'json',
    //   success: 'success',
    //   success: function(data) {

    //     $('#edit_id').val(id)
    //     $('#edit_id_barang').val(data['id_barang'])
    //     $('#edit_stok_tersedia').val(data['barang'][0]['stok'])
    //     $('#edit_permintaan_stok').val(data['permintaan_stok'])
    //   },
    //   error: function(data) {
    //     toastr.error('Gagal memanggil data! ')
    //   }
    // })
  });
</script>

@endsection