<?php

namespace App\Http\Controllers;

use App\Models\Departemen;
use Illuminate\Http\Request;

class DepartemenController extends Controller
{
    public function index()
    {
        $title = 'Departemen';
        $departemen = Departemen::orderBy('nama_departemen','asc')->get();

        return view('departemen.index',compact('title','departemen'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_departemen' => 'required|string|min:3|max:30',
        ]);

        $departemen = new Departemen;
        $departemen->nama_departemen = $request->nama_departemen;
        $departemen->save();

        \Session::flash('sukses','Data berhasil ditambahkan');
        return redirect()->back();
    }

    public function edit($id)
    {
        $title = 'Edit Departemen';
        $departemen = Departemen::findOrFail($id);

        return view('departemen.edit',compact('title','departemen'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_departemen' => 'required|string|min:3|max:30',
        ]);

        $departemen = Departemen::findOrFail($id);
        $departemen->nama_departemen = $request->nama_departemen;
        $departemen->update();

        \Session::flash('sukses','Data berhasil diupdate');
        return redirect('departemen');
    }

    public function destroy($id)
    {
        Departemen::findOrFail($id)->delete();

        \Session::flash('sukses','Berhasil dihapus');
        return redirect()->back();
    }
}
