<?php

namespace App\Http\Controllers;

use Facade\FlareClient\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $title = 'Halaman Dashboard';
        return View('dashboard.index',compact('title'));
    }

    public function update_password()
    {
        $title = 'Ubah password';
        return view('dashboard.update-password',compact('title'));
    }

    public function update(Request $request)
    {
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
			 \Session::flash('gagal','Password yang anda masukan salah');
            return redirect()->back();
        }

        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //Current password and new password are same
            \Session::flash("gagal","Password baru tidak boleh sama dengan password lama, silahkan pilih yang lain.");
            return redirect()->back();
        }

        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);

        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();

        \Session::flash("sukses","Password berhasil diubah");
        return redirect('dashboard');
    }
}
