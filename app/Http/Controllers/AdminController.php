<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Enums\OrderStatus;
use App\Events\OrderStatusUpdated;

class AdminController extends Controller
{
    /**
     * Menampilkan dashboard dengan pesanan aktif dan pesanan selesai.
     */
    public function dashboard()
    {
        // Mengambil semua pesanan yang statusnya PENDING atau IN_PROGRESS
        $activeOrders = Order::whereIn('status', [OrderStatus::PENDING, OrderStatus::IN_PROGRESS])
                                ->with('items')
                                ->latest('created_at') // Urutkan berdasarkan waktu dibuat
                                ->get();

        // Mengambil pesanan yang sudah selesai
        $completedOrders = Order::where('status', OrderStatus::COMPLETED)
                                ->with('items')
                                ->latest()
                                ->limit(10)
                                ->get();

        return view('admin.dashboard', compact('activeOrders', 'completedOrders'));
    }

    /**
     * Menampilkan detail satu pesanan.
     */
    public function show(Order $order)
    {
        $order->load('items.product'); 
        return view('admin.order_detail', compact('order'));
    }

    /**
     * Mengubah status pesanan.
     */
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate(['status' => 'required|string']);

        try {
            $newStatus = OrderStatus::from($request->status);
            $order->status = $newStatus;
            $order->save();

            // Tembakkan event agar pelanggan tahu statusnya berubah
            OrderStatusUpdated::dispatch($order->load('items.product'));

            return redirect()->route('admin.dashboard')->with('success', 'Status pesanan #' . $order->id . ' berhasil diperbarui.');
        } catch (\ValueError $e) {
            return back()->with('error', 'Status tidak valid.');
        }
    }
    /**
     * Laporan penjualan (harian, mingguan, bulanan)
     */
    public function laporan(Request $request)
    {
        $filter = $request->input('filter', 'bulan');
        $tanggal = $request->input('tanggal', now()->toDateString());
        $orders = Order::query();

        if ($filter == 'hari' && $tanggal) {
            $orders->whereDate('created_at', $tanggal);
        } elseif ($filter == 'minggu' && $tanggal) {
            $orders->whereBetween('created_at', [
                \Carbon\Carbon::parse($tanggal)->startOfWeek(),
                \Carbon\Carbon::parse($tanggal)->endOfWeek()
            ]);
        } elseif ($filter == 'bulan' && $tanggal) {
            $orders->whereMonth('created_at', \Carbon\Carbon::parse($tanggal)->month)
                   ->whereYear('created_at', \Carbon\Carbon::parse($tanggal)->year);
        }

        $orders = $orders->with('items')->get();
        // Hitung total per order
        foreach ($orders as $order) {
            $order->total = $order->items->sum(function($item) {
                return $item->price * $item->quantity;
            });
        }
        return view('admin.laporan.index', compact('orders', 'filter', 'tanggal'));
    }

    public function printLaporan(Request $request)
    {
        // Sama seperti laporan, tapi view print
        $filter = $request->input('filter', 'bulan');
        $tanggal = $request->input('tanggal', now()->toDateString());
        $orders = Order::query();

        if ($filter == 'hari' && $tanggal) {
            $orders->whereDate('created_at', $tanggal);
        } elseif ($filter == 'minggu' && $tanggal) {
            $orders->whereBetween('created_at', [
                \Carbon\Carbon::parse($tanggal)->startOfWeek(),
                \Carbon\Carbon::parse($tanggal)->endOfWeek()
            ]);
        } elseif ($filter == 'bulan' && $tanggal) {
            $orders->whereMonth('created_at', \Carbon\Carbon::parse($tanggal)->month)
                   ->whereYear('created_at', \Carbon\Carbon::parse($tanggal)->year);
        }

        $orders = $orders->with('items')->get();
        foreach ($orders as $order) {
            $order->total = $order->items->sum(function($item) {
                return $item->price * $item->quantity;
            });
        }
        return view('admin.laporan.print', compact('orders', 'filter', 'tanggal'));
    }
}