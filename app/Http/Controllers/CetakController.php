<?php

namespace App\Http\Controllers;

use App\Models\BarangKeluar;
use App\Models\BarangMasuk;
use App\Models\Pelanggaran;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PDF;

class CetakController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function cetak(Request $request)
    {
        $status_adm = $request->status_adm;
        $date = str_replace('/', '-', $request->start_date);
        $start = date('Y-m-d', strtotime($date));
        $date2 = str_replace('/', '-', $request->end_date);
        $end = date('Y-m-d h:m:s', strtotime($date2));

        if ($status_adm == 'selesai') {
            $laporan = Pelanggaran::with('user', 'perda')
                ->whereBetween('created_at', [$start, $end])
                ->where('status', 1)
                ->orWhere('jenis_sangsi', 'ditempat')
                ->orderBy('created_at', 'DESC')
                ->get();
        } else if ($status_adm == 'belum') {
            $laporan = Pelanggaran::with('user', 'perda')
                ->whereBetween('created_at', [$start, $end])
                ->where('status', 0)
                ->orderBy('created_at', 'DESC')
                ->get();
        } else {
            $status_adm = "sudah dan belum";
            $laporan = Pelanggaran::with('user', 'perda')
                ->whereBetween('created_at', [$start, $end])
                ->orderBy('created_at', 'DESC')
                ->get();
        }

        $pdf = PDF::loadview('cetak.laporan', compact('laporan', 'start', 'end', 'status_adm'))->setPaper('a4', 'landscape');



        return $pdf->stream();
    }
}
