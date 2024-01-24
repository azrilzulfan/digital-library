<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjaman = Peminjaman::all();
        return view('admin.peminjaman', compact('peminjaman'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'buku_id' => 'required|exists:buku,id',
        ]);

        $buku = Buku::find($request->buku_id);

        if ($buku->status_buku === 'N') {
            return redirect()->route('beranda')
                ->with('error', 'Buku sudah dipinjam. Tidak dapat dipinjam lagi.');
        }

        $tgl_pinjam = now();

        Peminjaman::create([
            'buku_id' => $request->buku_id,
            'users_id' => Auth::id(),
            'tgl_peminjaman' => $tgl_pinjam,
            'status_peminjaman' => 'N'
        ]);

        $buku->update(['status_buku' => 'N']);
        $buku->save();

        return redirect()->route('beranda')
            ->with('success', 'Peminjaman berhasil ditambahkan');
    }

    public function update($id)
    {
        $peminjaman = Peminjaman::find($id);
        $peminjaman->tgl_pengembalian = now();
        $peminjaman->update(['status_peminjaman' => 'Y']);

        $buku = Buku::find($peminjaman->buku_id);
        $buku->update(['status_buku' => 'Y']);

        return redirect()->route('peminjaman.index')
            ->with('success', 'Peminjaman berhasil diperbarui');
    }

    public function destroy($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->delete();

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil dihapus');
    }
}
