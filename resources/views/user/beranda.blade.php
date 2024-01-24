@extends('layouts.user')
@section('content')
    <div class="mb-8">
        <form class="flex items-center space-x-4">
            <div class="w-3/4">
                <label for="cariBuku" class="mb-2 text-sm font-medium text-gray-900 sr-only">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                    <input type="search" id="cariBuku" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-full bg-gray-50 focus:ring-blue-300 focus:border-blue-300" placeholder="Pencarian Buku ..." required>
                    <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm px-4 py-2">Cari</button>
                </div>
            </div>
            <div class="w-1/4">
                <select id="kategori" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-full focus:ring-blue-300 focus:border-blue-300 block w-full p-4">
                    <option selected>Pilih Kategori</option>
                </select>
            </div>
        </form>
    </div>

    <div class="mb-8">
        <div class="font-bold text-lg mb-2">Daftar Buku</div>
        <div class="flex space-x-0 items-center">
            <hr class="border-2 border-blue-600 cursor-pointer w-[105px]">
            <hr class="border-1 border-gray-300 cursor-pointer w-full">
        </div>
    </div>


    <div class="mb-8 px-10">
        <div class="grid grid-cols-7 gap-2" id="daftarBuku">
            @foreach ($buku as $buku)
            <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow">
                <a href="{{ route('buku.show', $buku->id) }}">
                    <img class="rounded-t-lg" src="{{ asset($buku->foto) }}" alt="{{ $buku->foto }}" />
                </a>
                <div class="p-5">
                    @foreach ($buku->kategoriBukuRelasi as $kategoriBuku)
                        <span class="px-3 py-2 text-xs font-medium text-center text-white bg-teal-400 rounded-lg hover:bg-teal-500">{{ $kategoriBuku->kategori->nama_kategori }}</span>
                    @endforeach
                    <p class="mb-3 mt-3 text-sm font-semibold text-gray-500">{{ $buku->judul }}</p>
                    <h5 class="mb-2 text-sm font-semibold tracking-tight text-gray-900">{{ $buku->penulis }}</h5>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection
