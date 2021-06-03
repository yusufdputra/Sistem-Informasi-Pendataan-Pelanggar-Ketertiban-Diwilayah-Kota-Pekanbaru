<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($jenis)
    {
        $title = "Kelola Data Pengguna " . strtoupper($jenis);
        $users = User::where('tipe_user', $jenis)->get();

        return view('admin.users.index', compact('title', 'users', 'jenis'));
    }

    public function store(Request $request)
    {
        // cek username or email
        try {
            $username = User::where('username', $request->username);
            $email = User::where('email', $request->email);
            if ($username->exists()) {
                return redirect()->back()->with('alert', 'Pengguna gagal ditambah, Nama Pengguna sudah terdaftar');
            }
            if ($email->exists()) {
                return redirect()->back()->with('alert', 'Pengguna gagal ditambah, Email sudah terdaftar');
            }

            $user = User::create([
                'username' => $request->username,
                'password' => bcrypt($request->username),
                'nama' => $request->nama,
                'email' => $request->email,
                'nomor_hp' => $request->nomor_hp,
                'tipe_user' => $request->role,
                'created_at' => Carbon::now()
            ]);

            $user->assignRole($request->role);

            if ($user) {
                return redirect()->back()->with('success', 'Pengguna berhasil ditambah');
            } else {
                return redirect()->back()->with('alert', 'Pengguna gagal ditambah');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('alert', 'Pengguna gagal ditambah.');
        }
    }

    public function edit(Request $request)
    {
        return User::find($request->id);
    }

    public function update(Request $request)
    {
        $email = User::where('email', $request->email);

       
        if (($request->email != $request->old_email) && $email->exists()) {
            return redirect()->back()->with('alert', 'Pengguna gagal diubah, Email sudah terdaftar');
        }
        $value = [
            'nama' => $request->nama,
            'email' => $request->email,
            'nomor_hp' => $request->nomor_hp,
        ];
        $query = User::where('id', $request->id)
            ->update($value);

        if ($query) {
            return redirect()->back()->with('success', 'Pengguna berhasil diubah');
        } else {
            return redirect()->back()->with('alert', 'Pengguna gagal diubah');
        }
    }

    public function hapus(Request $request)
    {

        $query = User::where('id', $request->id)
            ->delete();

        if ($query) {
            User::where('id', $request->id_user)->delete();
            return redirect()->back()->with('success', 'Berhasil menghapus user');
        } else {
            return redirect()->back()->with('alert', 'Gagal menghapus user');
        }
    }

    public function resetpw(Request $request)
    {
        $query = User::where('id', Auth::user()->id)
            ->update([
                'password' => bcrypt($request->password)
            ]);

        if ($query) {
            return redirect()->back()->with('success', 'Password User berhasil diubah');
        } else {
            return redirect()->back()->with('alert', 'Password User gagal diubah');
        }
    }

}
