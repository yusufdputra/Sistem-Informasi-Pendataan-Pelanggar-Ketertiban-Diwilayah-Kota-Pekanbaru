<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cetak LAPORAN</title>

  <style>
    html,
    body {
      margin: 0;
      padding: 0;
      height: 100%;
    }

    #container {
      min-height: 100%;
      position: relative;
    }

    #header {
      padding-left: 30px;
      padding-right: 30px;
      padding-top: 30px;
    }

    #body {
      padding: 30px;
      padding-bottom: 60px;
      /* Height of the footer */
    }

    #footer {
      position: absolute;
      bottom: 0;
      width: 100%;
      height: 60px;
    }
  </style>

</head>

<body>

  <div id="container">


    <div id="header">
      <div style="float: left;">
        <img height="120px" src="..\public\adminto\images\brand\pku.png" alt="">
      </div>
      <div style="float: right; ">
        <img height="120px" src="..\public\adminto\images\brand\logo.png" alt="">
      </div>
      <div style="text-align: center; ">
        <span style="font-size: 24px; font-weight: bold;">PEMERINTAH KOTA PEKANBARU</span> <br>
        <span style="font-size: 32px; font-weight: bold;">SATUAN POLISI PAMONG PRAJA</span> <br>
        <span style="font-size: 13px; font-weight: bold;">Jalan Jenderal Sudirman Telepon 31543 - 38765</span><br>
        <span style="font-size: 13px; font-weight: bold;">PEKANBARU - 28126</span><br>
        <br>
        <hr>
      </div>
    </div>
    <div id="body">
      <div style="font-size: 12px;">
        <p>Laporan Pelanggaran Tanggal {{date('d-M-Y', strtotime($start))}} s/d {{date('d-M-Y', strtotime($end))}} </p>

        <div style="font-size: 12px;">
          <table style="width: 100%; border-style: solid !important; border-collapse: collapse; " border="1">
            <thead>
              <tr>
                <th style="padding: 5px;">No.</th>
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
              </tr>
            </thead>
            <tbody style="text-align: center !important">

              @foreach($laporan as $key => $value)
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
                <img src="storage/{{$value->ktp_path}}" height="60px" class="m-b-20 thumb-img" alt="work-thumbnail">
                </td>
              </tr>
              @endforeach



            </tbody>
            </td>
          </table>
        </div>


        <div style="font-size: 12px;">

          <p style="text-align: right;">
            <strong>
              Pekanbaru, {{date('d-M-Y', strtotime(now()))}}
              <br>
              Mengetahui,
              <br>
              <br>
              <br>
              KEPALA SATUAN POLISI PAMONG PRAJA
              <br>
              <br>
              <br>
              <br>
              <br>
              <br>
              <br>
              IWAN SAMUEL PARLINDUNGAN SIMATUPANG, AP, S.Sos, M.Si
              <br>
              NIP. 19760705 199412 1 001
            </strong>
          </p>

        </div>


      </div>

    </div>

</body>

</html>