<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Admin Dashboard</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="font-sans antialiased bg-gray-100">
    <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-100" @keydown.escape.window="sidebarOpen = false">
        
        {{-- Overlay for mobile --}}
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

            <nav class="mt-4">
                {{-- Link Dashboard --}}
                <a href="{{ route('dashboard') }}" class="flex items-center px-6 py-3 {{ request()->routeIs('dashboard') ? 'text-white bg-gray-700' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                    <span class="mr-3"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg></span>
                    {{ __('Dashboard') }}
                </a>
                @if(Auth::user() && Auth::user()->role === 'admin')
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
                @endif
                {{-- Link Laporan --}}
                <a href="{{ route('admin.laporan') }}" class="flex items-center px-6 py-3 {{ request()->routeIs('admin.laporan') ? 'text-white bg-gray-700' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                    <span class="mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </span>
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
                                {{ __('Admin Dashboard') }}
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
                <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                    
                    @if(session('success'))
                        <div class="mb-8 p-5 bg-emerald-50 border-2 border-emerald-300 text-emerald-800 font-medium rounded-xl shadow-md flex items-center space-x-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            <span>{{ session('success') }}</span>
                        </div>
                    @endif

                    <div class="bg-white rounded-xl shadow-xl p-8 mb-10 border border-gray-200">
                        <h3 class="text-3xl font-extrabold text-gray-900 mb-7 border-b-2 pb-4 border-blue-300">Pesanan Aktif (Pending & Sedang Dibuat)</h3>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-300">
                                <thead class="bg-blue-50">
                                    <tr>
                                        <th class="py-4 px-6 text-left text-xs font-bold text-blue-700 uppercase tracking-wider">Order ID</th>
                                        <th class="py-4 px-6 text-left text-xs font-bold text-blue-700 uppercase tracking-wider">Meja</th>
                                        <th class="py-4 px-6 text-left text-xs font-bold text-blue-700 uppercase tracking-wider">Status</th>
                                        <th class="py-4 px-6 text-left text-xs font-bold text-blue-700 uppercase tracking-wider">Waktu Pesan</th>
                                        <th class="py-4 px-6 text-left text-xs font-bold text-blue-700 uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200" id="pending-orders-tbody">
                                    @forelse ($activeOrders as $order)
                                        <tr class="hover:bg-blue-50 transition-colors duration-200" id="order-row-{{ $order->id }}">
                                            <td class="py-4 px-6 whitespace-nowrap text-sm font-medium text-gray-800">#{{ $order->id }}</td>
                                            <td class="py-4 px-6 whitespace-nowrap text-sm text-gray-700">{{ $order->table_number }}</td>
                                            <td class="py-4 px-6 whitespace-nowrap">
                                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $order->status->color() }} text-gray-800 shadow-sm">{{ $order->status->label() }}</span>
                                            </td>
                                            <td class="py-4 px-6 whitespace-nowrap text-sm text-gray-600">{{ $order->created_at->format('H:i') }}</td>
                                            <td class="py-4 px-6 whitespace-nowrap">
                                                <a href="{{ route('admin.orders.show', $order) }}" class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-semibold rounded-lg shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Lihat Detail</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr id="no-pending-orders">
                                            <td colspan="5" class="py-8 px-6 text-center text-gray-500 text-lg italic">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                                Tidak ada pesanan aktif saat ini.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-xl p-8 border border-gray-200">
                        <h3 class="text-3xl font-extrabold text-gray-900 mb-7 border-b-2 pb-4 border-blue-300">Riwayat Pesanan Selesai (Terbaru)</h3>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-300">
                                <thead class="bg-blue-50">
                                    <tr>
                                        <th class="py-4 px-6 text-left text-xs font-bold text-blue-700 uppercase tracking-wider">Order ID</th>
                                        <th class="py-4 px-6 text-left text-xs font-bold text-blue-700 uppercase tracking-wider">Meja</th>
                                        <th class="py-4 px-6 text-left text-xs font-bold text-blue-700 uppercase tracking-wider">Total Harga</th>
                                        <th class="py-4 px-6 text-left text-xs font-bold text-blue-700 uppercase tracking-wider">Waktu Selesai</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse ($completedOrders as $order)
                                        <tr class="hover:bg-blue-50 transition-colors duration-200">
                                            <td class="py-4 px-6 whitespace-nowrap text-sm font-medium text-gray-800">#{{ $order->id }}</td>
                                            <td class="py-4 px-6 whitespace-nowrap text-sm text-gray-700">{{ $order->table_number }}</td>
                                            <td class="py-4 px-6 whitespace-nowrap text-sm text-gray-700">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                            <td class="py-4 px-6 whitespace-nowrap text-sm text-gray-600">{{ $order->updated_at->format('H:i, d M Y') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="py-8 px-6 text-center text-gray-500 text-lg italic">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" /></svg>
                                                Belum ada pesanan yang selesai.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </main>
        </div>
    </div>

    <script type="module">
        const newOrderRowTemplate = (order) => `
            <tr class="hover:bg-blue-50 transition-colors duration-200" id="order-row-${order.id}">
                <td class="py-4 px-6 whitespace-nowrap text-sm font-medium text-gray-800">#${order.id}</td>
                <td class="py-4 px-6 whitespace-nowrap text-sm text-gray-700">${order.table_number}</td>
                <td class="py-4 px-6 whitespace-nowrap">
                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full ${order.status_color} text-gray-800 shadow-sm">${order.status_label}</span>
                </td>
                <td class="py-4 px-6 whitespace-nowrap text-sm text-gray-600">${new Date(order.created_at).toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' })}</td>
                <td class="py-4 px-6 whitespace-nowrap">
                    <a href="/admin/orders/${order.id}" class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-semibold rounded-lg shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Lihat Detail</a>
                </td>
            </tr>
        `;

        if (window.Echo) {
            window.Echo.private('admin-channel')
                .listen('OrderPlaced', (e) => {
                    console.log('Pesanan baru diterima (admin):', e.order);
                    const tableBody = document.querySelector('#pending-orders-tbody');
                    const noOrdersRow = document.getElementById('no-pending-orders');
                    if(noOrdersRow) { noOrdersRow.remove(); }
                    tableBody.insertAdjacentHTML('afterbegin', newOrderRowTemplate(e.order));
                    
                    try { 
                        const audio = new Audio('/audio/notification.mp3');
                        audio.play(); 
                    } catch(err) {
                        console.warn('Gagal memutar notifikasi suara:', err);
                    }
                    
                    document.title = '(!) Pesanan Baru Masuk!';
                    setTimeout(() => { document.title = 'Admin Dashboard'; }, 5000);
                })
                .listen('OrderStatusUpdated', (e) => {
                    console.log('Status pesanan diperbarui (admin):', e.order);
                    const orderRow = document.getElementById(`order-row-${e.order_id}`);
                    if (orderRow) {
                        const statusSpan = orderRow.querySelector('span.rounded-full');
                        if (statusSpan) {
                            statusSpan.className = `px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full ${e.order.status_color} text-gray-800 shadow-sm`;
                            statusSpan.innerText = e.order.status_label;
                        }
                    }

                    if (e.order.status_label === 'Selesai' || e.order.status_label === 'Dibatalkan') {
                        const activeOrderRow = document.getElementById(`order-row-${e.order.id}`);
                        if (activeOrderRow) {
                            activeOrderRow.remove();

                            const completedTableBody = document.querySelector('div.bg-white:last-child tbody');
                            const noCompletedOrdersMsg = completedTableBody.querySelector('td[colspan="4"]');
                            if (noCompletedOrdersMsg) {
                                noCompletedOrdersMsg.closest('tr').remove();
                            }

                            const completedOrderTemplate = `
                                <tr class="hover:bg-blue-50 transition-colors duration-200">
                                    <td class="py-4 px-6 whitespace-nowrap text-sm font-medium text-gray-800">#${e.order.id}</td>
                                    <td class="py-4 px-6 whitespace-nowrap text-sm text-gray-700">${e.order.table_number}</td>
                                    <td class="py-4 px-6 whitespace-nowrap text-sm text-gray-700">Rp ${Number(e.order.total_price).toLocaleString('id-ID')}</td>
                                    <td class="py-4 px-6 whitespace-nowrap text-sm text-gray-600">${new Date(e.order.updated_at).toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' })}, ${new Date(e.order.updated_at).toLocaleDateString('id-ID', { day: '2-digit', month: 'short', year: 'numeric' })}</td>
                                </tr>
                            `;
                            completedTableBody.insertAdjacentHTML('afterbegin', completedOrderTemplate);
                            
                            const tableBody = document.querySelector('#pending-orders-tbody');
                            const remainingActiveOrders = document.querySelectorAll('#pending-orders-tbody tr');
                            if (remainingActiveOrders.length === 0 && !document.getElementById('no-pending-orders')) {
                                tableBody.insertAdjacentHTML('beforeend', `
                                    <tr id="no-pending-orders">
                                        <td colspan="5" class="py-8 px-6 text-center text-gray-500 text-lg italic">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                            Tidak ada pesanan aktif saat ini.
                                        </td>
                                    </tr>
                                `);
                            }
                        }
                    }
                });
        }
    </script>
    </body>
</html>