<?php

namespace App\Http\Controllers;

use App\Models\Pelanggaran;
use Illuminate\Http\Request;

class PelanggaranController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $title = "Kelola Data Pelanggaran";
        $pelanggaran = Pelanggaran::with('user')->orderBy('created_at', 'ASC')->get();
        return view('pelanggaran.index', compact('pelanggaran', 'title'));
    }
    public function baru()
    {
        $title = "Tambah Pelanggaran Baru";
        return view('pelanggaran.baru', compact('title'));
    }


}
