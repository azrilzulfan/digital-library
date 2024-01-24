<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            .mask-star-2:checked {
                background-color: #ffce00;
        }
        </style>
    </head>
    <body class="font-sans text-gray-900 bg-gray-50 antialiased">

            <!-- Navbar -->
            <div class="bg-white shadow p-6 mb-6">
                <div class="flex justify-between items-baseline">
                    <div class="font-extrabold text-blue-400 uppercase">
                        <span class="text-4xl font-bold text-blue-600">B</span>ooks
                    </div>
                    <div class="flex space-x-10 items-center">
                        <a href="{{ route('beranda') }}" class="hover:text-blue-600 active:text-blue-600">Beranda</a>
                        <a href="{{ route('koleksi.index') }}" class="hover:text-blue-600 active:text-blue-600">Koleksi</a>
                        <div class="">
                            <a href="#" class="bg-transparent text-green-400 border-2 border-green-400 hover:bg-green-400 hover:text-white hover:border-transparent font-bold rounded-full text-sm px-5 py-2.5 text-center me-2 flex items-center gap-2">
                                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                                </svg>
                                Pinjam Buku Baru
                            </a>
                        </div>
                    </div>
                    @if (Route::has('login'))
                        @auth
                            <div class="hidden sm:flex sm:items-center sm:ms-6">
                                <x-dropdown align="right" width="48">
                                    <x-slot name="trigger">
                                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                            <div>{{ Auth::user()->name }}</div>

                                            <div class="ms-1">
                                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        </button>
                                    </x-slot>

                                    <x-slot name="content">
                                        <x-dropdown-link :href="route('profile.edit')">
                                            {{ __('Profile') }}
                                        </x-dropdown-link>

                                        <!-- Authentication -->
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf

                                            <x-dropdown-link :href="route('logout')"
                                                    onclick="event.preventDefault();
                                                                this.closest('form').submit();">
                                                {{ __('Log Out') }}
                                            </x-dropdown-link>
                                        </form>
                                    </x-slot>
                                </x-dropdown>
                            </div>
                    @else
                        <div class="hidden sm:flex sm:items-center sm:ms-6 gap-2">
                            <button type="button" onclick="window.location.href='{{ route('login') }}'" class="w-24 text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">Login</button>
                            <button type="button" onclick="window.location.href='{{ route('register') }}'" class="w-24 text-white bg-green-400 hover:bg-green-500 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2">Register</button>
                        </div>
                        @endauth
                    @endif
                </div>
            </div>

        <div class="p-6">
            @yield('content')
        </div>

    </body>
</html>
