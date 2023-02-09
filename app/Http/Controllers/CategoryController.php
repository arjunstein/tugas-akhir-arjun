<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $title = 'Kategori Alat';
        $category = Category::orderBy('nama_category','asc')
                    ->get();

        return view('category.index',compact('title','category'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_category' => 'required|max:30|string',
        ]);

        $category = new Category;
        $category->nama_category = $request->nama_category;
        $category->save();
        
        \Session::flash('sukses','Data berhasil disimpan');
        return redirect('category');
    }

    public function edit($id)
    {
        $title = 'Edit kategori';
        $category = Category::findOrFail($id);
        return view('category.edit',compact('title','category'));
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'nama_category' => 'required|max:30|string',
        ]);

        $category = Category::findOrFail($id);
        $category->nama_category = $request->nama_category;
        $category->update();
        
        \Session::flash('sukses','Data berhasil diperbarui');
        return redirect('category');
    }

    public function destroy($id)
    {
        try {
            Category::findOrFail($id)->delete();
        
            \Session::flash('sukses','Data berhasil dihapus');
            return redirect('category');   

        } catch (Exception $e) {
            \Session::flash('info','Data tidak dapat dihapus, karena masih terdapat data di tabel alat');
            return redirect()->back();
        }
        
    }
}
