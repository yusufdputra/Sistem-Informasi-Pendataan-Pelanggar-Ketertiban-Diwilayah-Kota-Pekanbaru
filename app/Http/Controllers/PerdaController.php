<?php

namespace App\Http\Controllers;

use App\Models\Perda;
use App\Models\PerdaPelanggaran;
use App\Models\PerdaSangsi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PerdaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $title = "Kelola Peraturan Daerah";
        $perda = Perda::orderBy('created_at', 'ASC')->get();

        $pelanggarans = array();
        $sangsis = array();
        foreach ($perda as $key => $value) {
            // pelanggaran
            $pelanggaran = unserialize($value->pelanggaran);

            if (count($pelanggaran)  == 0) {
                $pelanggarans[$key] = null;
            } else {
                foreach ($pelanggaran as $k => $pel) {
                    $nama = PerdaPelanggaran::find($pel)->nama;
                    $pelanggarans[$key][$k] = $nama;
                }
            }
            // sangsi
            $sangsi = unserialize($value->jenis_sangsi);
            if (count($sangsi)  == 0) {
                $sangsis[$key] = null;
            } else {
                foreach ($sangsi as $k => $sang) {
                    $nama = PerdaSangsi::find($sang)->nama;
                    $sangsis[$key][$k] = $nama;
                }
            }
        }
        return view('admin.perda.index', compact('perda', 'title', 'pelanggarans', 'sangsis'));
    }

    public function store(Request $request)
    {
        try {
            $null = array();
            $query = Perda::insert([
                'nomor_perda' => $request->nomor,
                'nama_perda' => $request->nama,
                'pelanggaran' => serialize($null),
                'jenis_sangsi' => serialize($null),
                'created_at' => Carbon::now(),
            ]);
            if ($query) {
                return redirect()->back()->with('success', 'Peraturan berhasil ditambah, silahkan lengkapi');
            } else {
                return redirect()->back()->with('alert', 'Peraturan gagal ditambah');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('alert', 'Peraturan gagal ditambah');
        }
    }


    public function edit($id)
    {
        $perda = Perda::find($id);
        $title = "Kelola Peraturan Daerah " . strtoupper($perda['nama_perda']);
        // panggil pelanggaran perda
        $pelanggarans = array();
        foreach (unserialize($perda['pelanggaran']) as $key => $value) {
            $pelanggarans[$key] = PerdaPelanggaran::find($value);
        }

        // panggil sangsi perda
        $jenis_sangsi = array();
        foreach (unserialize($perda['jenis_sangsi']) as $key => $value) {
            $jenis_sangsi[$key] = PerdaSangsi::find($value);
        }

        return view('admin.perda.detail', compact('title', 'perda', 'pelanggarans', 'jenis_sangsi'));
    }

    public function hapus(Request $request)
    {
        $query = Perda::where('id', $request->id)->delete();

        if ($query) {
            return redirect()->back()->with('success', 'Berhasil menghapus Peraturan Daerah');
        } else {
            return redirect()->back()->with('alert', 'Gagal menghapus Peraturan Daerah');
        }
    }

    public function update(Request $request)
    {
        Perda::where('id', $request->id)
            ->update([
                'nomor_perda' => $request->nomor,
                'nama_perda' => $request->nama,
            ]);

        return redirect()->back()->with('success', 'Perda Berhasil diubah');
    }

    public static function getPerdaById($id)
    {
        $perda = Perda::find($id);
        $pelanggarans = array();
        $sangsis = array();
        // pelanggaran
        $pelanggaran = unserialize($perda['pelanggaran']);

        if (count($pelanggaran)  == 0) {
            $pelanggarans = null;
        } else {
            foreach ($pelanggaran as $k => $pel) {
                $nama = PerdaPelanggaran::find($pel);
                $pelanggarans[$k] = $nama;
            }
        }
        // sangsi
        $sangsi = unserialize($perda['jenis_sangsi']);
        if (count($sangsi)  == 0) {
            $sangsis = null;
        } else {
            foreach ($sangsi as $k => $sang) {
                $nama = PerdaSangsi::find($sang);
                $sangsis[$k] = $nama;
            }
        }

        return compact('pelanggarans', 'sangsis');
    }

    
}
