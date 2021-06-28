@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card-box">
      <a href="{{route('pelanggaran.index')}}" class="btn btn-danger m-l-10 waves-light mb-3">Kembali</a>

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

      <form class="form-horizontal m-t-20" enctype="multipart/form-data" action="{{route('pelanggaran.terima2')}}" method="POST">
        {{csrf_field()}}

        <input type="hidden" value="{{$pelanggaran['id']}}" name="id">

        <div class="col-lg-12 col-xs-12 row">
          <div class="col-lg-6 col-xs-12">
            <div class="form-group">
              <label for="">Nomor KTP</label>
              <div class="col-xs-12">
                <div class="input-group-append">
                  <input class="form-control" readonly value="{{$pelanggaran['no_ktp']}}" id="no_ktp" type="text">
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-6 col-xs-12">
            <div class="form-group">
              <label for="">Nama Lengkap</label>
              <div class="col-xs-12">
                <input class="form-control" value="{{$pelanggaran['nama']}}" readonly type="text">
              </div>
            </div>
          </div>
        </div>


        <div class="col-lg-12 col-xs-12 row">
          <div class="col-lg-6 col-xs-12">
            <div class="form-group">
              <label for="">Nama Perda</label>
              <div class="col-xs-12">
                <input class="form-control" value="{{$pelanggaran['perda'][0]['nama_perda']}}" readonly type="text">
              </div>
            </div>
          </div>

          <div class="col-lg-6 col-xs-12">
            <div class="form-group">
              <label for="">Pelanggaran Yang Ditemukan</label>
              <div class="col-xs-12">
                <input class="form-control" value="{{$pelanggaran['pelanggaran']}}" readonly type="text">
              </div>
            </div>
          </div>

        </div>


        <div class="col-lg-12 col-xs-12 row">
          <div class="col-lg-6 col-xs-12">
            <div class="form-group">
              <label for="">Jenis Sangsi</label>
              <div class="col-xs-12">
                <input class="form-control" value="{{$pelanggaran['sangsi']}}" readonly type="text">
              </div>
            </div>
          </div>

          <div class="col-lg-6 col-xs-12">
            <div class="form-group">
              <label for="">Lokasi Pelanggaran</label>
              <div class="col-xs-12">
                <textarea class="form-control" readonly type="text" autocomplete="off" name="lokasi" placeholder="Lokasi Pelanggaran" required="">{{$pelanggaran['lokasi']}}</textarea>
              </div>
            </div>
          </div>

        </div>

        <div class="col-lg-12 col-xs-12 row">
          <div class="col-lg-6 col-xs-12">
            <div class="form-group">
              <label for="">Penyelesaian Sangsi</label>
              <div class="col-xs-12">
                <select required class="form-control" name="jenis_sangsi" id="nama_perda">
                  <option selected disabled>Jenis Sangsi...</option>
                  <option {{$pelanggaran['jenis_sangsi'] == 'ditempat' ? 'selected' : '' }} value="ditempat">Penyelesaian Ditempat</option>
                  <option {{$pelanggaran['jenis_sangsi'] == 'dikantor' ? 'selected' : '' }} value="dikantor">Penyelesaian Dikantor</option>
                </select>
              </div>
            </div>
          </div>

          <div class="col-lg-6 col-xs-12">
            <div class="form-group">
              <label for="">Keterangan Foto Pelaksanaan Sangsi</label>
              <div class="col-xs-12">
                <textarea class="form-control" type="text" autocomplete="off" name="keterangan_sangsi" placeholder="Keterangan Foto Pelaksanaan Sangsi" required="">{{$pelanggaran['keterangan_sangsi']}}</textarea>
              </div>
            </div>
          </div>

        </div>

        <div class="col-lg-12 col-xs-12 row">

          <div class="col-lg-6 col-xs-12">
            <div class="form-group">
              <label for="">Foto Pelaksanaan Sangsi</label>
              <div class="col-xs-12">
                <div class="m-b-20" id="img_view">
                  @if($pelanggaran['sangsi_path'] != null)
                  <input type="hidden" name="foto_sangsi_old" value="{{$pelanggaran['sangsi_path']}}" id="foto_sangsi_old">
                  <img src="../../../storage/{{$pelanggaran['sangsi_path']}}" class="m-b-20 thumb-img" alt="work-thumbnail">
                  @else
                  <div class="alert alert-danger">
                    Foto belum di upload
                  </div>
                  <!-- <input type="file" required name="foto_sangsi" class="dropify" data-max-file-size="5M" accept=".png, .jpg, .jpeg" /> -->
                  @endif
                </div>
              </div>
            </div>
          </div>


          @if($pelanggaran['jenis_sangsi'] == 'dikantor')
          <div class="col-lg-6 col-xs-12">
            <div class="form-group">
              <label for="">Ubah Foto Pelaksanaan Sangsi</label>
              <div class="col-xs-12">
                <div class="m-b-20" id="img_view">
                  <input type="hidden" name="foto_sangsi_old" value="{{$pelanggaran['sangsi_path']}}" id="foto_sangsi_old">
                  <input type="file" required name="foto_sangsi" class="dropify" data-max-file-size="5M" accept=".png, .jpg, .jpeg" />
                </div>
              </div>
            </div>
          </div>
          @endif
        </div>

        <div class="form-group text-center m-t-30">
          <div class="col-xs-12">
            <button class="btn btn-success btn-bordred btn-block waves-effect waves-light" type="submit">Terima</button>
          </div>
        </div>


      </form>


    </div>
  </div>
</div>
<!-- end row -->


@endsection