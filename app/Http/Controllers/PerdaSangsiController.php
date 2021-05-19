<?php

namespace App\Http\Controllers;

use App\Models\Perda;
use App\Models\PerdaSangsi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PerdaSangsiController extends Controller
{
    public function store(Request $request)
    {
        try {

            $query = new PerdaSangsi();
            $query->nama = $request->nama;
            $query->created_at = Carbon::now();
            if ($query->save()) {
                $id_sangsi = $query->id;
                $perda = Perda::find($request->id);
                // tambah

                $sangsi_already = unserialize($perda['jenis_sangsi']);
                array_push($sangsi_already, $id_sangsi);

                Perda::where('id', $request->id)
                    ->update([
                        'jenis_sangsi' => serialize($sangsi_already)
                    ]);
                return redirect()->back()->with('success', 'Sangsi Peraturan berhasil ditambah');
            } else {
                return redirect()->back()->with('alert', 'Sangsi Peraturan gagal ditambah');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('alert', 'Sangsi Peraturan gagal ditambah ' );
        }
    }

    
    public function hapus(Request $request)
    {
        try {
            // get data tabel perda by id
            $perda = Perda::where('id', $request->perdaId)->first();
            //get array 
            $id_jenis_sangsi = unserialize($perda['jenis_sangsi']);
            // cari di array berdasarkan value
            // kemudian hapus
            $key = array_search($request->hapusId, $id_jenis_sangsi);
            if ($key !== false) {
                // hapus
                unset($id_jenis_sangsi[$key]);
            }
            // update array id pelanggaran di tabel Perda
            Perda::where('id', $request->perdaId)
                ->update([
                    'jenis_sangsi' => serialize($id_jenis_sangsi)
                ]);
            // hapus di tabel perda pelanggaran
            $query = PerdaSangsi::where('id', $request->hapusId)->delete();
            if ($query) {
                return redirect()->back()->with('success', 'Berhasil menghapus Sangsi');
            } else {
                return redirect()->back()->with('alert', 'Gagal menghapus Sangsi');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('alert', 'Gagal menghapus Sangsi ');
        }
    }

    public function edit(Request $request)
    {
        PerdaSangsi::where('id', $request->id)
            ->update([
                'nama' => $request->nama
            ]);

        return redirect()->back()->with('success', 'Sangsi Berhasil diubah');
    }
}
