<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class AlatController extends Controller
{
    public function index()
    {
        $title = 'Data alat';
        $alat = Alat::orderBy('id','asc')
                ->get();
        $category = Category::latest()
                ->get();
        
        return view('alat.index',compact('title','alat','category'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_alat' => 'required|max:30|string',
            'category_id' => 'required',
            'desc' => 'required|string|max:50',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // upload gambar
        $image = $request->file('image');
        $image->storeAs('public/alats', $image->getClientOriginalName());

        Alat::create([
            'image' => $image->getClientOriginalName(),
            'nama_alat' => $request->nama_alat,
            'category_id' => $request->category_id,
            'desc' => $request->desc,
        ]);

        \Session::flash('sukses','Data berhasil ditambahkan');
        return redirect('alat');
    }

    public function edit($id)
    {
        $title = 'Edit data alat';
        $category = Category::latest()->get();
        $alat = Alat::findOrFail($id);

        return view('alat.edit',compact('title','alat','category'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'nama_alat' => 'required|max:30|string',
            'category_id' => 'required',
            'desc' => 'required|string|max:50',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);
        
        if ($request->hasFile('image')) {

            //upload new image
           $image = $request->file('image');
           $image->storeAs('public/alats', $image->getClientOriginalName());

            //delete old image
            $alat = Alat::findOrFail($id);
            $path = storage_path('app/public/alats/'.$alat->image);
            if (File::exists($path)) {
                File::delete($path);
            }

           //update alat with new image
           $alat = Alat::findOrFail($id);
           $alat->image = $image->getClientOriginalName();
           $alat->nama_alat = $request->nama_alat;
           $alat->category_id = $request->category_id;
           $alat->desc = $request->desc;
           $alat->update();
                

        } else {

           //update alat without image
           $alat = Alat::findOrFail($id);
           $alat->nama_alat = $request->nama_alat;
           $alat->category_id = $request->category_id;
           $alat->desc = $request->desc;
           $alat->update();
                
        }

        \Session::flash('sukses','Data berhasil diperbarui');
        return redirect('alat');
    }

    public function destroy($id)
    {
        $alat = Alat::findOrFail($id);
        $alat->delete();

        //delete image in storage
        $path = storage_path('app/public/alats/'.$alat->image);
        if (File::exists($path)) {
            File::delete($path);
        }
        
        \Session::flash('sukses','Data berhasil dihapus');
        return redirect('alat');
    }
}
