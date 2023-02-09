<?php

namespace App\Http\Controllers;

use App\Models\Datapegawai;
use Illuminate\Http\Request;

class DatapegawaiController extends Controller
{
    public function index()
    {
        $title = 'Data pegawai';
        $datapegawai = Datapegawai::latest()->get();

        return view('data-pegawai.index',compact('title','datapegawai'));
    }
}
