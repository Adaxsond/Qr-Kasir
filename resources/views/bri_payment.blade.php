<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Virtual Account BRI</title>
    <style>
        body { font-family: system-ui, sans-serif; background: #f4f4f9; color: #333; }
        .container { max-width: 400px; margin: 4em auto; background: white; padding: 2em; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); text-align: center; }
        .paycode { font-size: 2em; font-weight: bold; letter-spacing: 0.1em; color: #2563eb; margin: 2em 0; }
        .btn-success { display: inline-block; margin-top: 2em; padding: 0.7em 2em; background: #2563eb; color: white; border: none; border-radius: 8px; font-size: 1em; cursor: pointer; text-decoration: none; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Pembayaran via Virtual Account BRI</h1>
        <p>Gunakan kode pembayaran berikut di aplikasi bank Anda:</p>
        <div class="paycode">BRIVA-1234567890123456</div>
        <button onclick="window.location.href='{{ url('/order_success') }}'" class="btn-success">Saya Sudah Bayar</button>
    </div>
</body>
</html>
