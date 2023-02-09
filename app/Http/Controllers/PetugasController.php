<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PetugasController extends Controller
{
    public function index()
    {
        $title = 'Kelola petugas';
        $petugas = Petugas::latest()->get();
        // $data = DB::table('petugas')
        //     ->join('users', 'users.name', '=', 'petugas.nama_petugas')
        //     ->select('users.*', 'petugas.*')
        //     ->get();

        return view('petugas.index',compact('title','petugas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_petugas' => 'required|string|max:30',
            'jabatan' => 'required|max:50',
            'no_telp' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:14',
        ]);

        $petugas = new Petugas;
        $petugas->nama_petugas = $request->nama_petugas;
        $petugas->jabatan = $request->jabatan;
        $petugas->no_telp = $request->no_telp;
        $petugas->user_id = 1 + 1;
        $petugas->save();

        $user = new User;
        $user->name = $petugas->nama_petugas;
        $user->email = $petugas->no_telp;
        $user->password = bcrypt('petugas123');
        $user->role = 'petugas';
        $user->save();

        return redirect('petugas')->with('sukses','Petugas berhasil dibuat');
    }

    public function edit($id)
    {
        $title = 'Edit petugas';
        $petugas = Petugas::findOrFail($id);

        return view('petugas.edit',compact('title','petugas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_petugas' => 'required|string|max:30',
            'jabatan' => 'required|max:50',
            'no_telp' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:14',
        ]);

        $petugas = Petugas::findOrFail($id);
        $petugas->nama_petugas = $request->nama_petugas;
        $petugas->jabatan = $request->jabatan;
        $petugas->no_telp = $request->no_telp;
        $petugas->update();
        
        return redirect('petugas')->with('sukses','Data berhasil diupdate');
    }

    public function destroy($id)
    {
        Petugas::findOrFail($id)->delete();
        
        return redirect()->back()->with('sukses','Data berhasil dihapus');
    }
}
