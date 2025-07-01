<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Laporan Penjualan</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <style>
        body { font-family: 'Figtree', Arial, sans-serif; background: #fff; color: #222; }
        .print-container { max-width: 900px; margin: 0 auto; padding: 2em; }
        h1 { text-align: center; font-size: 2em; margin-bottom: 1.5em; }
        table { width: 100%; border-collapse: collapse; margin-top: 1em; background: #fff; }
        th, td { border: 1px solid #e0e0e0; padding: 12px 16px; text-align: left; }
        th { background: #e3eafc; color: #1e3a8a; font-size: 1em; text-transform: uppercase; }
        tr:nth-child(even) { background: #f8fafc; }
        .status { padding: 4px 12px; border-radius: 8px; background: #e0f7e9; color: #18804b; font-weight: 600; font-size: 0.95em; }
        @media print {
            body { background: #fff !important; }
            .print-container { box-shadow: none; border: none; }
        }
    </style>
</head>
<body>
    <div class="print-container">
        <h1>Laporan Penjualan</h1>
        <table>
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>No. Order</th>
                    <th>Total</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                <tr>
                    <td>{{ $order->created_at->format('Y-m-d') }}</td>
                    <td>#{{ $order->id }}</td>
                    <td>Rp {{ number_format($order->total,0,',','.') }}</td>
                    <td><span class="status">{{ $order->status }}</span></td>
                </tr>
                @empty
                <tr><td colspan="4" style="text-align:center; padding:2em; color:#888;">Tidak ada data</td></tr>
                @endforelse
            </tbody>
        </table>
        <button onclick="window.location.href='{{ route('admin.laporan') }}'" style="margin-top:2em; padding:10px 24px; background:#2563eb; color:#fff; border:none; border-radius:8px; font-size:1em; cursor:pointer;">
            &larr; Kembali
        </button>
    </div>
    <script>window.onload = function() { window.print(); }</script>
</body>
</html>
