<?php

namespace App\Http\Controllers;

use App\Models\Departemen;
use App\Models\Pengguna;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Data Pengguna';
        $pengguna = Pengguna::latest()
                    ->get();
        $departemen = Departemen::latest()->get();
        
        return view('pengguna.index',compact('title','pengguna','departemen'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $request->validate([
            'nama' => 'required|string|max:50',
            'departemen_id' => 'required',
            'jabatan' => 'required|string|max:50',
            'no_hp' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:14',
        ]);

        $pengguna = new Pengguna;
        $pengguna->nama = $request->nama;
        $pengguna->departemen_id = $request->departemen_id;
        $pengguna->jabatan = $request->jabatan;
        $pengguna->no_hp = $request->no_hp;
        $pengguna->save();

        $user = new User;
        $user->name = $pengguna->nama;
        $user->email = $pengguna->no_hp;
        $user->password = bcrypt('12345');
        $user->role = 'user';
        $user->save();

        \Session::flash('sukses','Data berhasil ditambahkan');
        return redirect('pengguna');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = 'Edit data pengguna';
        $pengguna = Pengguna::findOrFail($id);
        $departemen = Departemen::latest()->get();

        return view('pengguna.edit',compact('title','pengguna','departemen'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:50',
            'departemen_id' => 'required',
            'jabatan' => 'required|string|max:50',
            'no_hp' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:14',
        ]);

        $pengguna = Pengguna::findOrFail($id);
        $pengguna->nama = $request->nama;
        $pengguna->departemen_id = $request->departemen_id;
        $pengguna->jabatan = $request->jabatan;
        $pengguna->no_hp = $request->no_hp;
        $pengguna->update();

        \Session::flash('sukses','Data berhasil diperbarui');
        return redirect('pengguna');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Pengguna::findOrFail($id)->delete();
        
        // DB::table('penggunas')
        //         ->join('users','penggunas.id','=','users.id')
        //         ->where('penggunas.id',$id)
        //         ->delete();
        
        return redirect('pengguna')->with('sukses','Data berhasil dihapus');
    }
}
