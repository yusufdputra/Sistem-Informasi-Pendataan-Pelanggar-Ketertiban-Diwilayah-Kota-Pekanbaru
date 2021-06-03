<?php

namespace App\Http\Controllers;

use App\Models\Perda;
use App\Models\PerdaPelanggaran;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PerdaPelanggaranController extends Controller
{
    public function store(Request $request)
    {
        try {
            $query = new PerdaPelanggaran;
            $query->nama = $request->nama;
            $query->created_at = Carbon::now();
            if ($query->save()) {
                $id_pelanggaran = $query->id;
                $perda = Perda::find($request->id);
                // tambah

                $pelanggaran_already = unserialize($perda['pelanggaran']);

                array_push($pelanggaran_already, $id_pelanggaran);

                Perda::where('id', $request->id)
                    ->update([
                        'pelanggaran' => serialize($pelanggaran_already),
                        'updated_at' => Carbon::now(),
                    ]);
                return redirect()->back()->with('success', 'Pelanggaran Peraturan berhasil ditambah');
            } else {
                return redirect()->back()->with('alert', 'Pelanggaran Peraturan gagal ditambah');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('alert', 'Pelanggaran Peraturan gagal ditambah ');
        }
    }

    public function hapus(Request $request)
    {
        try {
            // get data tabel perda by id
            $perda = Perda::where('id', $request->perdaId)->first();
            //get array 
            $id_perda_pelanggaran = unserialize($perda['pelanggaran']);
            // cari di array berdasarkan value
            // kemudian hapus
            $key = array_search($request->hapusId, $id_perda_pelanggaran);
            if ($key !== false) {
                // hapus
                unset($id_perda_pelanggaran[$key]);
            }
            // update array id pelanggaran di tabel Perda
            Perda::where('id', $request->perdaId)
                ->update([
                    'pelanggaran' => serialize($id_perda_pelanggaran)
                ]);
            // hapus di tabel perda pelanggaran
            $query = PerdaPelanggaran::where('id', $request->hapusId)->delete();
            if ($query) {
                return redirect()->back()->with('success', 'Berhasil menghapus Pelanggaran');
            } else {
                return redirect()->back()->with('alert', 'Gagal menghapus Pelanggaran');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('alert', 'Gagal menghapus Pelanggaran ');
        }
    }

    public function edit(Request $request)
    {
        PerdaPelanggaran::where('id', $request->id)
            ->update([
                'nama' => $request->nama
            ]);
        Perda::where('id', $request->id_perda)
            ->update([
                'updated_at' => Carbon::now(),
            ]);

        return redirect()->back()->with('success', 'Pelanggaran Berhasil diubah');
    }
}
