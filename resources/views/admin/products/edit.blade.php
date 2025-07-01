<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Edit Produk</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="font-sans antialiased bg-gray-100">
    <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-100" @keydown.escape.window="sidebarOpen = false">
        
        {{-- Overlay --}}
        <div 
            x-show="sidebarOpen" 
            @click="sidebarOpen = false"
            x-transition:enter="transition-opacity ease-linear duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity ease-linear duration-300"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-black bg-opacity-50 z-20"
            x-cloak
        ></div>

        {{-- Sidebar --}}
        <aside 
            class="fixed inset-y-0 left-0 z-30 w-64 bg-gray-800 text-white transform transition-transform duration-300 ease-in-out"
            :class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen}"
        >
            <div class="flex justify-between items-center px-4 py-4 bg-gray-900">
                <h2 class="text-xl font-bold text-white">SAO Admin</h2>
                <button @click="sidebarOpen = false" class="p-1 text-gray-400 hover:text-white rounded-full focus:outline-none focus:ring-2 focus:ring-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            {{-- Navigasi Sidebar yang sudah diperbarui --}}
            <nav class="mt-4">
                {{-- Link Dashboard --}}
                <a href="{{ route('dashboard') }}" class="flex items-center px-6 py-3 {{ request()->routeIs('dashboard') ? 'text-white bg-gray-700' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                    <span class="mr-3"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg></span>
                    {{ __('Dashboard') }}
                </a>
                {{-- Link Kategori --}}
                <a href="{{ route('admin.categories.index') }}" class="flex items-center px-6 py-3 {{ request()->routeIs('admin.categories.*') ? 'text-white bg-gray-700' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                    <span class="mr-3"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg></span>
                    {{ __('Kategori') }}
                </a>
                {{-- Link Produk --}}
                <a href="{{ route('admin.products.index') }}" class="flex items-center px-6 py-3 {{ request()->routeIs('admin.products.*') ? 'text-white bg-gray-700' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                     <span class="mr-3"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg></span>
                    {{ __('Produk') }}
                </a>
                {{-- Link Laporan --}}
                <a href="{{ route('admin.laporan') }}" class="flex items-center px-6 py-3 {{ request()->routeIs('admin.laporan') ? 'text-white bg-gray-700' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                    <span class="mr-3"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" /></svg></span>
                    {{ __('Laporan') }}
                </a>
            </nav>
        </aside>
        
        {{-- Main Content --}}
        <div class="flex-1 flex flex-col overflow-hidden">
            
            <header class="bg-white border-b border-gray-100 shadow-sm">
                <div class="px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex items-center">
                            <div class="mr-4 flex items-center">
                                <button @click="sidebarOpen = !sidebarOpen" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none">
                                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                    </svg>
                                </button>
                            </div>
                            <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                                {{ __('Manajemen Produk') }}
                            </h2>
                        </div>
                        
                        <div class="hidden sm:flex sm:items-center">
                            @auth
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none">
                                        <div>{{ Auth::user()->name }}</div>
                                        <div class="ml-1"><svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg></div>
                                    </button>
                                </x-slot>
                                <x-slot name="content">
                                    <x-dropdown-link :href="route('profile.edit')">{{ __('Profile') }}</x-dropdown-link>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">{{ __('Log Out') }}</x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                            @endauth
                        </div>
                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto">
                <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
                    
                    <div class="bg-white rounded-xl shadow-xl p-8 border border-gray-200">
                        <h3 class="text-3xl font-extrabold text-gray-900 mb-7 border-b-2 pb-4 border-blue-300">
                            Edit Produk: <span class="text-blue-600">{{ $product->name }}</span>
                        </h3>
                        
                        <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                                {{-- Kolom Kiri --}}
                                <div>
                                    <div class="mb-6">
                                        <label for="name" class="block text-base font-semibold text-gray-700 mb-2">Nama Produk</label>
                                        <input id="name" class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" type="text" name="name" value="{{ old('name', $product->name) }}" required>
                                        @error('name')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                                    </div>
    
                                    <div class="mb-6">
                                        <label for="category_id" class="block text-base font-semibold text-gray-700 mb-2">Kategori</label>
                                        <select name="category_id" id="category_id" class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                            <option value="">Pilih Kategori</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                                    </div>
    
                                    <div class="mb-6">
                                        <label for="price" class="block text-base font-semibold text-gray-700 mb-2">Harga</label>
                                        <div class="relative">
                                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                                <span class="text-gray-500 sm:text-sm">Rp</span>
                                            </div>
                                            <input id="price" class="block w-full pl-9 pr-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" type="number" name="price" value="{{ old('price', $product->price) }}" required>
                                        </div>
                                        @error('price')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                                    </div>
                                </div>

                                {{-- Kolom Kanan --}}
                                <div>
                                    <div class="mb-6">
                                        <label for="description" class="block text-base font-semibold text-gray-700 mb-2">Deskripsi Singkat</label>
                                        <textarea id="description" name="description" rows="5" class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('description', $product->description) }}</textarea>
                                        @error('description')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                                    </div>

                                    <div class="mb-6">
                                        <label for="image" class="block text-base font-semibold text-gray-700 mb-2">Gambar Produk</label>
                                        <img src="{{ $product->image_path ? asset('storage/' . $product->image_path) : 'https://via.placeholder.com/150' }}" alt="{{ $product->name }}" class="w-32 h-32 object-cover rounded-lg my-2 shadow-md">
                                        <p class="text-xs text-gray-500 mb-2">Kosongkan jika tidak ingin mengubah gambar.</p>
                                        <input type="file" name="image" id="image" class="block w-full text-sm text-gray-600
                                            file:mr-4 file:py-2.5 file:px-4
                                            file:rounded-lg file:border-0
                                            file:text-sm file:font-semibold
                                            file:bg-blue-50 file:text-blue-700
                                            hover:file:bg-blue-100 transition-colors duration-200 cursor-pointer">
                                        @error('image')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="flex items-center justify-end mt-8 pt-6 border-t border-gray-200 space-x-4">
                                <a href="{{ route('admin.products.index') }}" class="inline-flex items-center justify-center px-5 py-2.5 border border-gray-300 text-sm font-semibold rounded-lg text-gray-800 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400">
                                    {{ __('Batal') }}
                                </a>
                                <button type="submit" class="inline-flex items-center justify-center px-5 py-2.5 border border-transparent text-sm font-semibold rounded-lg shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 -ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    {{ __('Perbarui Produk') }}
                                </button>
                            </div>
                        </form>
                    </div>

                </div>
            </main>
        </div>
    </div>
</body>
</html>