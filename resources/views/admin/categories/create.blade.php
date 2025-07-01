<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Tambah Kategori</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak] { display: none !important; }
        .image-preview {
            width: 100%;
            height: 200px;
            border: 2px dashed #ddd;
            border-radius: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            background-color: #f9fafb;
            color: #6b7280;
        }
        .image-preview img {
            max-width: 100%;
            max-height: 100%;
            object-fit: cover;
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-100">
    <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-100" @keydown.escape.window="sidebarOpen = false">
        
        <div 
            x-show="sidebarOpen" 
            @click="sidebarOpen = false"
            x-transition:enter="transition-opacity ease-linear duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity ease-linear duration-300"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-black bg-opacity-50 z-20 lg:hidden"
            x-cloak
        ></div>
        <aside 
            class="fixed inset-y-0 left-0 z-30 w-64 bg-gray-800 text-white transform transition-transform duration-300 ease-in-out lg:translate-x-0"
            :class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen}"
        >
            <div class="flex justify-between items-center px-4 py-4 bg-gray-900">
                <h2 class="text-xl font-bold text-white">SAO Admin</h2>
                <button @click="sidebarOpen = false" class="p-1 text-gray-400 hover:text-white rounded-full focus:outline-none focus:ring-2 focus:ring-gray-500 lg:hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <nav class="mt-4">
                <a href="{{ route('dashboard') }}" class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-700 hover:text-white">
                    <span class="mr-3"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/></svg></span>
                    {{ __('Dashboard') }}
                </a>
                <a href="{{ route('admin.categories.index') }}" class="flex items-center px-6 py-3 bg-gray-700 text-white">
                    <span class="mr-3"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg></span>
                    {{ __('Kategori') }}
                </a>
                <a href="{{ route('admin.products.index') }}" class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-700 hover:text-white">
                     <span class="mr-3"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg></span>
                    {{ __('Produk') }}
                </a>
                <a href="{{ route('admin.laporan') }}" class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-700 hover:text-white">
                    <span class="mr-3"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2m0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" /></svg></span>
                    {{ __('Laporan') }}
                </a>
            </nav>
        </aside>
        <div class="flex-1 flex flex-col overflow-hidden">
            
            <header class="bg-white border-b border-gray-100 shadow-sm">
                <div class="px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex items-center">
                            <button @click="sidebarOpen = !sidebarOpen" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none lg:hidden">
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                </svg>
                            </button>
                            <h2 class="font-bold text-2xl text-gray-800 leading-tight ml-2 lg:ml-0">
                                {{ __('Manajemen Kategori') }}
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
                <div class="max-w-2xl mx-auto py-10 sm:px-6 lg:px-8">
                    
                    <div class="bg-white rounded-xl shadow-xl p-8 border border-gray-200">
                        <div class="border-b-2 pb-4 border-blue-300 mb-7">
                            <h3 class="text-2xl font-extrabold text-gray-900">Tambah Kategori Baru</h3>
                            <p class="text-sm text-gray-500 mt-1">Isi detail di bawah ini untuk menambahkan kategori produk baru.</p>
                        </div>
                        
                        <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="space-y-6">
                                {{-- Nama Kategori --}}
                                <div>
                                    <label for="name" class="block text-base font-semibold text-gray-700 mb-2">Nama Kategori</label>
                                    <input id="name" class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out" 
                                           type="text" name="name" value="{{ old('name') }}" required autofocus placeholder="Contoh: Makanan Berat, Minuman Dingin">
                                    @error('name')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                

                                {{-- Deskripsi --}}
                                <div>
                                    <label for="description" class="block text-base font-semibold text-gray-700 mb-2">Deskripsi (Opsional)</label>
                                    <textarea id="description" name="description" rows="3" class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out" placeholder="Jelaskan sedikit tentang kategori ini...">{{ old('description') }}</textarea>
                                    @error('description')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="flex items-center justify-end mt-8 pt-6 border-t border-gray-200 space-x-4">
                                <a href="{{ route('admin.categories.index') }}" class="inline-flex items-center justify-center px-5 py-2.5 border border-gray-300 text-sm font-semibold rounded-lg text-gray-800 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400 transition-all duration-200">
                                    {{ __('Batal') }}
                                </a>
                                <button type="submit" class="inline-flex items-center justify-center px-5 py-2.5 border border-transparent text-sm font-semibold rounded-lg shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 -ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                                    </svg>
                                    {{ __('Simpan Kategori') }}
                                </button>
                            </div>
                        </form>
                    </div>

                </div>
            </main>
            </div>
    </div>
    <script>
        function previewImage(event) {
            const reader = new FileReader();
            const imagePreview = document.getElementById('image-preview-el');
            const previewText = document.getElementById('preview-text');

            reader.onload = function(){
                imagePreview.src = reader.result;
                imagePreview.classList.remove('hidden');
                previewText.classList.add('hidden');
            }
            if (event.target.files[0]) {
                reader.readAsDataURL(event.target.files[0]);
            }
        }
    </script>
</body>
</html>