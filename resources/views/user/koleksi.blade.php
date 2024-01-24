@extends('layouts.user')
@section('content')

    <div class="mb-8">
        <div class="flex justify-between items-baseline">
            <div class="text-2xl font-bold">
                Koleksi Buku
            </div>
            <div>
                <button data-modal-target="modalTambah" data-modal-toggle="modalTambah" type="button" class="bg-transparent text-green-400 border-2 border-green-400 hover:bg-green-400 hover:text-white hover:border-transparent font-bold rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center mb-5">
                    <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                    </svg>
                    Tambah Buku
                </button>
            </div>
        </div>
        <div class="flex space-x-0 items-center">
            <hr class="border-2 border-blue-500 cursor-pointer w-[155px]">
            <hr class="border-1 border-gray-300 cursor-pointer w-full">
        </div>
    </div>

    <div class="mb-8">
        <div class="grid grid-cols-7 gap-4">
            @foreach ($koleksi as $koleksi)
                @if ($koleksi->users_id == Auth::id())
                <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow">
                    <a href="{{ route('buku.show', $koleksi->peminjaman->buku->id) }}">
                        <img class="rounded-t-lg" src="{{ $koleksi->peminjaman->buku->foto }}" alt="" />
                    </a>
                    <div class="p-5">
                        @foreach ($koleksi->peminjaman->buku->kategoriBukuRelasi as $kategori)
                        <a href="" class="px-3 py-2 text-xs font-medium text-center text-white bg-teal-400 rounded-lg hover:bg-teal-500">{{ $kategori->kategori->nama_kategori }}</a>
                        @endforeach
                        <p class="mb-3 mt-3 text-sm font-semibold text-gray-500">{{ $koleksi->peminjaman->buku->judul }}</p>
                        <h5 class="mb-2 text-sm font-semibold tracking-tight text-gray-900">{{ $koleksi->peminjaman->buku->penulis }}</h5>
                    </div>
                </div>
                @endif
            @endforeach
        </div>
    </div>

@endsection

<!-- Modal Tambah -->
<div id="modalTambah" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                <h3 class="text-lg font-semibold text-gray-900">
                    Tambah Buku
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-toggle="modalTambah">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form action="{{ route('koleksi.store') }}" method="POST" enctype="multipart/form-data" class="p-4 md:p-5">
                @csrf
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <label for="peminjaman_id" class="block mb-2 text-sm font-medium text-gray-900">Buku</label>
                        <select name="peminjaman_id" id="peminjaman_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                            <option selected="">Pilih Buku</option>
                            @foreach ($peminjaman as $peminjaman)
                                <option value="{{ $peminjaman->id }}">{{ $peminjaman->buku->judul }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                    Simpan
                </button>
            </form>
        </div>
    </div>
</div>
