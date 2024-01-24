<?php

namespace App\Http\Controllers;

use App\Models\KategoriBuku;
use App\Models\Koleksi;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class KoleksiController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $koleksi = Koleksi::all();
        $peminjaman = Peminjaman::where('users_id', $userId)->get();
        $kategori = KategoriBuku::whereHas('buku.peminjaman', function ($query) use ($userId) {
            $query->where('users_id', $userId);})->get();        
        return view('user.koleksi', compact('koleksi','peminjaman','kategori'));
    }

    public function store(Request $request)
    {
        $userId = Auth::id();

        $validator = Validator::make($request->all(), [
            'peminjaman_id' => 'required|exists:peminjaman,id,users_id,'.$userId,
        ]);

        if ($validator->fails()) {
            $firstError = $validator->errors()->first();

            return redirect()->back()->with('error', $firstError)->withErrors($validator)->withInput();
        }

        Koleksi::create([
            'users_id' => $userId,
            'peminjaman_id' => $request->peminjaman_id
        ]);

        return redirect()->route('koleksi.index')->with('success', 'Koleksi pribadi berhasil disimpan.');
    }
}
