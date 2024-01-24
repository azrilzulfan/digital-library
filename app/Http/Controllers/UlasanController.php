<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Ulasan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UlasanController extends Controller
{
    public function index($id)
    {
        $buku = Buku::findOrFail($id);
        $ulasan = Ulasan::where('buku_id', $buku->id)->paginate(1);
        $avg = Ulasan::where('buku_id', $buku->id)->avg('rating');
        return view('user.buku', compact('buku', 'ulasan', 'avg'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'buku_id' => 'required|exists:buku,id',
            'ulasan' => 'string',
            'rating' => 'required|numeric',
        ]);

        Ulasan::create([
            'buku_id' => $request->buku_id,
            'users_id' => Auth::id(),
            'ulasan' => $request->ulasan,
            'rating' => $request->rating,
        ]);

        $buku = Buku::find($request->buku_id);

        return redirect()->route('buku.show', $buku->id)
            ->with('success', 'Ulasan berhasil ditambahkan');
    }
}
