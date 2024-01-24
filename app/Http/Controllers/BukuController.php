<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BukuController extends Controller
{
    public function index()
    {
        $buku = Buku::all();
        return view('admin.buku', compact('buku'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'foto' => 'image|nullable|mimes:png,jpg,gif|max:2048',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required',
        ]);

        if($request->has('foto')){

            $file = $request->file('foto');
            $extension = $file->getClientOriginalName();

            $filename = $extension;

            $path = 'img/';
            $file->move($path, $filename);
        }

        Buku::create([
            'judul' => $request->judul,
            'foto' => $path.$filename,
            'penulis' => $request->penulis,
            'penerbit' => $request->penerbit,
            'tahun_terbit' => $request->tahun_terbit,
            'status_buku'     => 'Y',
        ]);

        return redirect()->route('dataBuku.index')
            ->with('success', 'Buku created successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required',
            'foto' => 'image|nullable|mimes:png,jpg,gif|max:2048',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required',
        ]);

        $buku = Buku::findOrFail($id);

        if ($request->has('foto')) {
            $file = $request->file('foto');
            $extension = $file->getClientOriginalName();
            $filename = $extension;
            $path = 'img/';
            $file->move($path, $filename);

            if ($buku->foto) {
                unlink(public_path($buku->foto));
            }

            $buku->update([
                'judul' => $request->judul,
                'foto' => $path.$filename,
                'penulis' => $request->penulis,
                'penerbit' => $request->penerbit,
                'tahun_terbit' => $request->tahun_terbit,
            ]);
        } else {
            $buku->update([
                'judul' => $request->judul,
                'penulis' => $request->penulis,
                'penerbit' => $request->penerbit,
                'tahun_terbit' => $request->tahun_terbit,
            ]);
        }

        return redirect()->route('dataBuku.index')
            ->with('success', 'Buku updated successfully.');
    }

    public function destroy($id)
    {
        $buku = Buku::findOrFail($id);

        if ($buku->foto) {
            unlink(public_path($buku->foto));
        }

        $buku->delete();

        return redirect()->route('dataBuku.index')
            ->with('success', 'Buku deleted successfully.');
    }
}
