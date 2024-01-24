<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\KategoriBuku;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $buku = Buku::latest()->get();
        return view('user.beranda', compact('buku'));
    }
}
