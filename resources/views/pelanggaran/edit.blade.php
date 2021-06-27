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

      <form class="form-horizontal m-t-20" enctype="multipart/form-data" action="{{route('pelanggaran.update')}}" method="POST">
        {{csrf_field()}}

        <input type="hidden" value="{{$pelanggaran['id']}}" name="id">

        <div class="col-lg-12 col-xs-12 row">
          <div class="col-lg-6 col-xs-12">
            <div class="form-group">
              <label for="">Nomor KTP</label>
              <div class="col-xs-12">
                <div class="input-group-append">
                  <input class="form-control" value="{{$pelanggaran['no_ktp']}}" id="no_ktp" type="text" autocomplete="off" name="no_ktp" required="" placeholder="Nomor KTP">
                  <a href="#" class="cariKtp"><span class="input-group-text btn-success"><i class="mdi mdi-account-search"></i></span></a>

                </div>
              </div>
              <div id="info_pelanggaran" style="display: none;" class="alert alert-info fade show m-b-0 mt-2">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4>Catatan Pelanggaran!</h4>
                <table id="table_info_pelanggaran" class="table table-sm " width="100%">
                  <thead>
                    <tr>
                      <th>Tanggal</th>
                      <th>Pelanggaran</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>

              </div>
            </div>
          </div>

          <div class="col-lg-6 col-xs-12">
            <div class="form-group">
              <label for="">Nama Lengkap</label>
              <div class="col-xs-12">
                <input class="form-control" value="{{$pelanggaran['nama']}}" type="text" autocomplete="off" name="nama" required="" placeholder="Nama Pelanggar">
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-12 col-xs-12 row">
          <div class="col-lg-6 col-xs-12">
            <div class="form-group">
              <label for="">Tempat Lahir</label>
              <div class="col-xs-12">
                @php
                $ttl = explode("-",$pelanggaran['ttl']);
                @endphp
                <input class="form-control" value="{{$ttl[0]}}" type="text" autocomplete="off" name="tempat_lahir" required="" placeholder="Sesuai KTP">
              </div>
            </div>
          </div>

          <div class="col-lg-6 col-xs-12">
            <div class="form-group">
              <label for="">Tanggal Lahir</label>
              <div class="col-xs-12">
                <input class="form-control datepicker-autoclose" value="{{$ttl[1]}}" type="text" autocomplete="off" name="tgl_lahir" required="" placeholder="dd/mm/yyyy">
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
                  <option {{$pelanggaran['jns_kelamin'] == 'lk' ? 'selected' : '' }} value="lk">Laki-Laki</option>
                  <option {{$pelanggaran['jns_kelamin'] == 'pr' ? 'selected' : '' }} value="pr">Perempuan</option>
                </select>
              </div>
            </div>
          </div>

          <div class="col-lg-6 col-xs-12">
            <div class="form-group">
              <label for="">Agama</label>
              <div class="col-xs-12">
                <select required class="form-control" name="agama">
                  <option {{$pelanggaran['agama'] == 'Islam' ? 'selected' : '' }} value="Islam">Islam</option>
                  <option {{$pelanggaran['agama'] == 'Protestan' ? 'selected' : '' }} value="Protestan">Protestan</option>
                  <option {{$pelanggaran['agama'] == 'Katolik' ? 'selected' : '' }} value="Katolik">Katolik</option>
                  <option {{$pelanggaran['agama'] == 'Hindu' ? 'selected' : '' }} value="Hindu">Hindu</option>
                  <option {{$pelanggaran['agama'] == 'Buddha' ? 'selected' : '' }} value="Buddha">Buddha</option>
                  <option {{$pelanggaran['agama'] == 'Khonghucu' ? 'selected' : '' }} value="Khonghucu">Khonghucu</option>
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
                <input class="form-control" value="{{$pelanggaran['pekerjaan']}}" type="text" autocomplete="off" name="pekerjaan" required="" placeholder="Pekerjaan">
              </div>
            </div>
          </div>

          <div class="col-lg-6 col-xs-12">
            <div class="form-group">
              <label for="">Alamat</label>
              <div class="col-xs-12">
                <textarea class="form-control" type="text" autocomplete="off" name="alamat" placeholder="Alamat Sesuai KTP" required="">{{$pelanggaran['alamat']}}</textarea>

              </div>
            </div>
          </div>

        </div>

        <div class="col-lg-12 col-xs-12 row">
          <div class="col-lg-6 col-xs-12">
            <div class="form-group">
              <label for="">Nama Perda</label>
              <div class="col-xs-12">
                <select required class="form-control" name="nama_perda" id="nama_perda">
                  <option selected disabled>Silahkan Pilih...</option>
                  @foreach ($perda as $key => $value)
                  <option {{$pelanggaran['nama_perda'] == $value->id ? 'selected' : '' }} value="{{$value->id}}">{{$value->nama_perda}}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>

          <div class="col-lg-6 col-xs-12">
            <div class="form-group">
              <label for="">Pelanggaran Yang Ditemukan</label>
              <div class="col-xs-12">
                <select required class="form-control" id="perdaPelanggaran" name="perdaPelanggaran">
                  <option selected disabled>Silahkan Pilih...</option>
                  @foreach ($getPerda['pelanggarans'] as $key => $value)
                  <option {{$pelanggaran['pelanggaran'] == $value->nama ? 'selected' : '' }} value="{{$value->nama}}">{{$value->nama}}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>

        </div>


        <div class="col-lg-12 col-xs-12 row">
          <div class="col-lg-6 col-xs-12">
            <div class="form-group">
              <label for="">Jenis Sangsi</label>
              <div class="col-xs-12">
                <select required class="form-control" id="jenisSangsi" name="jenisSangsi">
                  <option selected disabled>Silahkan Pilih...</option>
                  @foreach ($getPerda['sangsis'] as $key => $value)
                  <option {{$pelanggaran['sangsi'] == $value->nama ? 'selected' : '' }} value="{{$value->nama}}">{{$value->nama}}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>

          <div class="col-lg-6 col-xs-12">
            <div class="form-group">
              <label for="">Nomor Hp</label>
              <div class="col-xs-12">
                <input class="form-control" value="{{$pelanggaran['nomor_hp']}}" type="text" autocomplete="off" name="no_hp" required="" placeholder="Nomor Hp">
              </div>
            </div>
          </div>

        </div>

        <div class="col-lg-12 col-xs-12 row">
          <div class="col-lg-6 col-xs-12">
            <div class="form-group">
              <label for="">Lokasi Pelanggaran</label>
              <div class="col-xs-12">
                <textarea class="form-control" type="text" autocomplete="off" name="lokasi" placeholder="Lokasi Pelanggaran" required="">{{$pelanggaran['lokasi']}}</textarea>
              </div>
            </div>
          </div>

          <div class="col-lg-6 col-xs-12">
            <div class="form-group">
              <label for="">Keterangan</label>
              <div class="col-xs-12">
                <textarea class="form-control" type="text" autocomplete="off" name="keterangan" placeholder="Keterangan Pelanggaran" required="">{{$pelanggaran['keterangan']}}</textarea>
              </div>
            </div>
          </div>

        </div>

        <!-- 
        <div class="col-lg-12 col-xs-12">
          <div class="form-group">
            <label for="">Foto KTP</label>
            <div class="col-xs-12">
              <input type="file" required name="foto_ktp" class="dropify" data-max-file-size="5M" accept=".png, .jpg, .jpeg" />
            </div>
          </div>
        </div> -->

        <div class="col-lg-12 col-xs-12 row">

          <div class="col-lg-6 col-xs-12">
            <div class="form-group">
              <label for="">Foto Pelaksanaan Sangsi</label>
              <div class="col-xs-12">
                <div class="m-b-20" id="img_view">
                  @if($pelanggaran['sangsi_path'] != null)
                  <img src="../../../storage/{{$pelanggaran['sangsi_path']}}" class="m-b-20 thumb-img" alt="work-thumbnail">
                  @else
                  <div class="alert alert-danger">
                    <p>Foto belum di upload</p>
                  </div>
                  @endif
                </div>
              </div>
            </div>
          </div>


          <div class="col-lg-6 col-xs-12">
            <div class="form-group">
              <label for="">Foto Pelaksanaan Sangsi</label>
              <div class="col-xs-12">
                <input type="hidden" name="foto_sangsi_old" value="{{$pelanggaran['sangsi_path']}}" id="foto_sangsi_old">
                <input type="file" name="foto_sangsi" class="dropify" data-max-file-size="5M" accept=".png, .jpg, .jpeg" />
              </div>
            </div>
          </div>

        </div>



        <div class="form-group text-center m-t-30">
          <div class="col-xs-12">
            <button class="btn btn-success btn-bordred btn-block waves-effect waves-light" type="submit">Update</button>
          </div>
        </div>


      </form>


    </div>
  </div>
</div>
<!-- end row -->

<script type="text/javascript">
  $('.cariKtp').click(function() {
    var info_palanggaran = document.getElementById('info_pelanggaran')
    var no_ktp = document.getElementById('no_ktp').value

    if (no_ktp.length != 0) {
      if ($.fn.dataTable.isDataTable('#table_info_pelanggaran')) {

        dataTable = $('#table_info_pelanggaran').DataTable();
      } else {
        dataTable = $('#table_info_pelanggaran').DataTable({
          paging: false,
          searching: false
        })
      }
      $.ajax({
        url: '{{url("getPelanggaran")}}/' + no_ktp,
        type: 'GET',
        dataType: 'json',
        success: 'success',
        success: function(data) {
          if (data.length == 0) {
            toastr.error('Tidak Ada Pelanggaran Ditemukan')
            info_palanggaran.style.display = "none";
          } else {
            dataTable.clear().draw()
            var monthNames = ["January", "February", "March", "April", "May", "June",
              "July", "August", "September", "October", "November", "December"
            ];
            data.forEach(element => {
              var date = new Date(element['created_at'])
              var getDate = date.getDate() + '-' + monthNames[date.getMonth()] + '-' + date.getFullYear()
              dataTable.row.add([
                getDate,
                element['pelanggaran']
              ]).draw()
            });
            info_palanggaran.style.display = "block";

          }

        },
        error: function(data) {
          toastr.error('Gagal memanggil data! ')
          info_palanggaran.style.display = "none";
        }
      })
    } else {
      toastr.error('Isi Nomor KTP!')
      info_palanggaran.style.display = "none";
    }
    // $('#edit_id').val(id)


  });

  document.getElementById('nama_perda').addEventListener("change", function() {
    $('#perdaPelanggaran').html('')
    $('#jenisSangsi').html('')
    $.ajax({
      url: '{{url("getPerda")}}/' + this.value,
      type: 'GET',
      dataType: 'json',
      success: 'success',
      success: function(data) {
        $.each(data['pelanggarans'], function(i, currData) {
          var opt_pelanggaran = new Option(currData['nama'], currData['nama'])
          $('#perdaPelanggaran').append(opt_pelanggaran)
        })

        $.each(data['sangsis'], function(i, currData) {
          var opt_sangsi = new Option(currData['nama'], currData['nama'])
          $('#jenisSangsi').append(opt_sangsi)
        })

      },
      error: function(data) {
        toastr.error('Gagal memanggil data! ')
      }
    })
  })
</script>

@endsection