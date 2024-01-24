<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\KategoriBuku;
use Illuminate\Http\Request;

class KategoriBukuController extends Controller
{
    public function index()
    {
        $kategoriBuku = KategoriBuku::all();
        $buku = Buku::all();
        $kategori = Kategori::all();
        return view('admin.kategoriBuku', compact('kategoriBuku','buku','kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'buku_id' => 'required',
            'kategori_id' => 'required',
        ]);

        KategoriBuku::create($request->all());

        return redirect()->route('kategoriBuku.index')->with('success', 'Kategori Buku berhasil ditambahkan');
    }

    // public function edit($id)
    // {
    //     $kategoriBuku = KategoriBuku::findOrFail($id);
    //     $buku = Buku::all();
    //     $kategori = Kategori::all();
    //     return view('admin.kategoriBuku', compact('kategoriBuku','buku', 'kategori'));
    // }

    public function update(Request $request, $id)
    {
        $request->validate([
            'buku_id' => 'required',
            'kategori_id' => 'required',
        ]);

        $kategoriBuku = KategoriBuku::findOrFail($id);
        $kategoriBuku->update($request->all());

        return redirect()->route('kategoriBuku.index')->with('success', 'Kategori Buku berhasil diperbarui');
    }

    public function destroy($id)
    {
        $kategoriBuku = KategoriBuku::findOrFail($id);
        $kategoriBuku->delete();

        return redirect()->route('kategoriBuku.index')->with('success', 'Kategori Buku berhasil dihapus');
    }
}
