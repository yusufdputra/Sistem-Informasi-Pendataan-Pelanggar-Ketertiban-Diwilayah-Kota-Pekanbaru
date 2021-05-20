<?php

namespace App\Http\Controllers;

use App\Models\Pelanggaran;
use App\Models\Perda;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PelanggaranController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $title = "Kelola Data Pelanggaran";
        $pelanggaran = Pelanggaran::with('user', 'perda')->orderBy('status', 'ASC')->get();
        return view('pelanggaran.index', compact('pelanggaran', 'title'));
    }
    public function baru()
    {
        $title = "Tambah Pelanggaran Baru";
        $perda = Perda::all();
        return view('pelanggaran.baru', compact('title', 'perda'));
    }

    public function getPelanggaran($ktp)
    {
        return Pelanggaran::where('no_ktp', $ktp)->get();
    }

    public function store(Request $request)
    {
        try {
            $files = $request->file();

            if ($files == null) {
                return redirect()->back()->with('alert', 'Foto KTP tidak ditemukan. Coba lagi.');
            } else {
                $file_name = time() . '_' . $files['foto_ktp']->getClientOriginalName();
                $file_path = $files['foto_ktp']->storeAs('uploads', $file_name, 'public');


                $query = Pelanggaran::insert([
                    'no_ktp' => $request->no_ktp,
                    'nama' => $request->nama,
                    'ttl' => $request->tempat_lahir . '-' . $request->tgl_lahir,
                    'jns_kelamin' => $request->jns_kelamin,
                    'agama' => $request->agama,
                    'pekerjaan' => $request->pekerjaan,
                    'alamat' => $request->alamat,
                    'nomor_hp' => $request->no_hp,
                    'nama_perda' => $request->nama_perda,
                    'pelanggaran' => $request->perdaPelanggaran,
                    'sangsi' => $request->jenisSangsi,
                    'keterangan' => $request->keterangan,
                    'lokasi' => $request->lokasi,
                    'ktp_path' => $file_path,
                    'status' => 0,
                    'id_petugas' => Auth::id(),
                    'created_at' => Carbon::now(),
                ]);

                if ($query) {
                    return redirect()->back()->with('success', 'Pelanggaran Baru Berhasil di tambah');
                } else {
                    return redirect()->back()->with('alert', 'Pelanggaran Baru Gagal di tambah');
                }
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('alert', 'Terjadi Kesalahan Saat Upload Gambar. Coba lagi.' . $th);
        }
    }

    public function edit($id)
    {
        $title = "Edit Data Pelanggaran";
        $perda = Perda::all();
        $pelanggaran = Pelanggaran::with('user', 'perda')->where('id', $id)->first();

        $getPerda = PerdaController::getPerdaById($pelanggaran['nama_perda']);
        return view('pelanggaran.edit', compact('pelanggaran', 'title', 'perda', 'getPerda'));
    }

    public function hapus(Request $request)
    {
        $query = Pelanggaran::where('id', $request->id)->delete();

        if ($query) {
            return redirect()->back()->with('success', 'Berhasil menghapus Pelanggaran');
        } else {
            return redirect()->back()->with('alert', 'Gagal menghapus Pelanggaran');
        }
    }

    public function update(Request $request)
    {
        try {

            $query = Pelanggaran::where('id', $request->id)
            ->update([
                'no_ktp' => $request->no_ktp,
                'nama' => $request->nama,
                'ttl' => $request->tempat_lahir . '-' . $request->tgl_lahir,
                'jns_kelamin' => $request->jns_kelamin,
                'agama' => $request->agama,
                'pekerjaan' => $request->pekerjaan,
                'alamat' => $request->alamat,
                'nomor_hp' => $request->no_hp,
                'nama_perda' => $request->nama_perda,
                'pelanggaran' => $request->perdaPelanggaran,
                'sangsi' => $request->jenisSangsi,
                'keterangan' => $request->keterangan,
                'lokasi' => $request->lokasi,
            ]);

            if ($query) {
                return redirect()->back()->with('success', 'Pelanggaran Baru Berhasil di ubah');
            } else {
                return redirect()->back()->with('alert', 'Pelanggaran Baru Gagal di ubah');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('alert', 'Terjadi Kesalahan. Coba lagi.' . $th);
        }
    }
}
