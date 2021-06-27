<?php

namespace App\Http\Controllers;

use App\Models\Pelanggaran;
use App\Models\Perda;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PelanggaranController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $title = "Kelola Data Pelanggaran";

        if (Auth::user()->roles[0]['name'] == 'pimpinan') {
            $pelanggaran = Pelanggaran::with('user', 'perda')->where('status', 1)->orderBy('created_at', 'DESC')->get();
        } else {
            $pelanggaran = Pelanggaran::with('user', 'perda')->orderBy('created_at', 'DESC')->orderBy('status', 'ASC')->get();
        }
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
        return Pelanggaran::where('no_ktp', $ktp)->orderBy('created_at', 'DESC')->get();
    }

    public function store(Request $request)
    {
        try {
            $files = $request->file();

            if (($_FILES["foto_ktp"]['name']) == null) {
                return redirect()->back()->with('alert', 'Foto KTP tidak ditemukan. Coba lagi.');
            } else {
                // upload foto ktp
                $file_name_ktp = time() . '_' . $files['foto_ktp']->getClientOriginalName();
                $ktp_path = $files['foto_ktp']->storeAs('uploads', $file_name_ktp, 'public');
                // upload foto sangsi jika ada

                $sangsi_path = null;
                if (($_FILES["foto_sangsi"]['name']) != null) {
                    $file_name_sangsi = time() . '_' . $files['foto_sangsi']->getClientOriginalName();
                    $sangsi_path = $files['foto_sangsi']->storeAs('uploads', $file_name_sangsi, 'public');
                }


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
                    'ktp_path' => $ktp_path,
                    'sangsi_path' => $sangsi_path,
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
        $pelanggaran = Pelanggaran::find($request->id);
        // dd($pelanggaran['ktp_path']);
        $image_path = public_path('\storage/' . $pelanggaran['ktp_path']);
        // Storage::disk('public')->delete('/storage/uploads/'.$pelanggaran['ktp_path']);
        unlink($image_path);

        $query = $pelanggaran->delete();

        if ($query) {
            return redirect()->back()->with('success', 'Berhasil menghapus Pelanggaran');
        } else {
            return redirect()->back()->with('alert', 'Gagal menghapus Pelanggaran');
        }
    }

    public function update(Request $request)
    {
        try {
            $files = $request->file();
            $sangsi_path = $request->foto_sangsi_old;
            if (($_FILES["foto_sangsi"]['name']) != null) {

                $file_name_sangsi = time() . '_' . $files['foto_sangsi']->getClientOriginalName();
                $sangsi_path = $files['foto_sangsi']->storeAs('uploads', $file_name_sangsi, 'public');

                // hapus foto lama di folder
                if ($request->foto_sangsi_old != null) {
                    $image_path_old = public_path('\storage/' . $request->foto_sangsi_old);
                    unlink($image_path_old);
                }
            }



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
                    'sangsi_path' => $sangsi_path,
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

    public function terima($id)
    {
        $title = "Terima Pelanggaran";
        $pelanggaran = Pelanggaran::with('perda')
            ->where('id', $id)
            ->first();
        return view('pelanggaran.terima', compact('title', 'pelanggaran'));
    }

    public function terima2(Request $request)
    {
        try {
            $id = $request->id;

            if ($request->foto_sangsi_old == null) {
                $files = $request->file();
                if (($_FILES["foto_sangsi"]['name']) != null) {
                    $file_name_sangsi = time() . '_' . $files['foto_sangsi']->getClientOriginalName();
                    $sangsi_path = $files['foto_sangsi']->storeAs('uploads', $file_name_sangsi, 'public');
                }
            } else {
                $sangsi_path = $request->foto_sangsi_old;
            }

            Pelanggaran::where('id', $id)
                ->update([
                    'status' => 1,
                    'sangsi_path' => $sangsi_path,
                ]);

            return redirect('pelanggaran')->with('success', 'Pelanggaran Berhasil Di Approve');
        } catch (\Throwable $th) {
            return redirect()->back()->with('alert', 'Pelanggaran Gagal Di Approve');
        }
    }
}
