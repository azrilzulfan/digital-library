@extends('layouts.user')
@section('content')
    <div class="container flex gap-5 w-3/4 mx-auto mb-5">
        <div class="w-[60%]">
            <div class="mb-5">
                <button type="button" onclick="history.back()">
                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M13 5H1m0 0 4 4M1 5l4-4"/>
                    </svg>
                </button>
            </div>
            <div class="mb-10 text-sm">
                @foreach ($buku->kategoriBukuRelasi as $kategoriBuku)
                    <span class="text-gray-400">{{ $kategoriBuku->kategori->nama_kategori }}</span> / {{ $buku->judul }}
                @endforeach
            </div>
            <div class="mb-5 text-3xl font-bold">
                {{ $buku->judul }}
            </div>
            <div class="font-semibold mb-2">
                {{ $buku->penulis }}
            </div>
            <div class="my-5">
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Provident, dolorem asperiores deleniti ullam eum sint mollitia non sequi, pariatur laboriosam ipsa illo voluptates cum, quidem ea. Sequi sit quisquam aliquid.
            </div>
            <div class="text-sm flex gap-5">
                <div>
                    <div class="mb-1 font-semibold">Penerbit</div>
                    <div>{{ $buku->penerbit }}</div>
                </div>
                <div>
                    <div class="mb-1 font-semibold">Tahun Terbit</div>
                    <div>{{ $buku->tahun_terbit }}</div>
                </div>
            </div>
            <div>
                @if ($buku->status_buku === 'Y')
                    <form action="{{ route('peminjaman.store') }}" method="POST">
                        @csrf
                        <div>
                            <input type="hidden" name="buku_id" value="{{ $buku->id }}">
                        </div>
                        <div class="mt-10">
                            <button type="submit" class="w-36 text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">Pinjam Buku</button>
                        </div>
                    </form>
                @else
                    <div class="mt-10">
                        <button type="button" onclick="history.back()" class="w-40 text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2">Buku Tidak Tersedia</button>
                    </div>
                @endif
            </div>
            <div class="mt-10">
                <div class="text-2xl font-bold mb-5">Ulasan</div>
                <div class="flex gap-20 mb-10">
                    <div>
                        <div class="mb-2 font-semibold">Total Ulasan</div>
                        <div class="text-xl font-bold flex gap-2 items-center">{{ $ulasan->total() }} <span class="px-2 py-1 text-xs font-medium text-center text-white bg-green-400 rounded-lg hover:bg-green-500">Ulasan</span> </div>
                    </div>
                    <div>
                        <div class="mb-2 font-semibold">Rating</div>
                        <div class="text-xl font-bold flex gap-2 items-center">
                            {{ number_format($avg, 1) }}
                            <input type="radio" disabled class="mask mask-star-2 bg-yellow-300" />
                        </div>
                    </div>
                </div>
                <div>
                    <div class="container w-full p-4 shadow">
                        <div class="text-xl font-medium mb-5">Ulasan</div>
                        <div>
                            <form action="{{ route('ulasan.store') }}" method="POST">
                                @csrf
                                <div>
                                    <input type="hidden" name="buku_id" value="{{ $buku->id }}">
                                </div>
                                <div class="rating">
                                    <input type="radio" name="rating" value="1" class="mask mask-star-2 bg-yellow-300" />
                                    <input type="radio" name="rating" value="2" class="mask mask-star-2 bg-yellow-300" />
                                    <input type="radio" name="rating" value="3" class="mask mask-star-2 bg-yellow-300" />
                                    <input type="radio" name="rating" value="4" class="mask mask-star-2 bg-yellow-300" checked/>
                                    <input type="radio" name="rating" value="5" class="mask mask-star-2 bg-yellow-300" />
                                </div>
                                <div class="mt-2">
                                    <textarea id="ulasan" name="ulasan" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Leave a comment..."></textarea>
                                </div>
                                <div class="mt-5 text-end">
                                    <button type="submit" class="w-36 text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-[40%]">
            <div>
                <img class="w-[400px] h-[550px] rounded-lg shadow" src="{{ asset($buku->foto) }}" alt="">
            </div>
            <div class="mt-9">
                @if ($ulasan->count() > 0)
                    <div class="container w-full p-4 shadow mb-2">
                        @foreach ($ulasan as $data)
                            <div class="flex justify-between">
                                <div class="text-xl font-medium mb-5">
                                    <div>{{ $data->users->name }}</div>
                                    <div class="text-sm text-gray-400">{{ $data->users->email }}</div>
                                </div>
                                <div class="text-xl font-bold flex gap-2 items-center">
                                    {{ $data->rating }}
                                    <input type="radio" disabled class="mask mask-star-2 bg-yellow-300" />
                                </div>
                            </div>
                            <div>
                                <div class="mt-2">
                                    <p class="border rounded-lg p-4">{{ $data->ulasan }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    {{ $ulasan->links() }}
                @else
                    <div class="flex items-center p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50">
                        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                        </svg>
                        <div>
                            Belum ada ulasan untuk buku ini.
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
