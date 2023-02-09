<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Peminjaman;
use App\Models\Petugas;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index()
    {
        $title = 'Peminjaman alat';
        $peminjaman = Peminjaman::orderBy('tanggal_peminjaman','asc')->get();
        $alat = Alat::get();
        $petugas = Petugas::get();

        return view('peminjaman.index',compact('title','peminjaman','alat','petugas'));
    }
}
