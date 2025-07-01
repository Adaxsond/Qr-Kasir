<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran QRIS</title>
    <style>
        body { font-family: system-ui, sans-serif; background: #f4f4f9; color: #333; }
        .container { max-width: 400px; margin: 4em auto; background: white; padding: 2em; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); text-align: center; }
        .barcode { margin: 2em 0; }
        .barcode img { width: 220px; height: 220px; border-radius: 12px; border: 2px solid #e5e7eb; }
        .btn-back { display: inline-block; margin-top: 2em; padding: 0.7em 2em; background: #2563eb; color: white; border: none; border-radius: 8px; font-size: 1em; cursor: pointer; text-decoration: none; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Pembayaran via QRIS</h1>
        <p>Silakan scan barcode di bawah ini untuk membayar.</p>
        <div class="barcode">
            <img src="https://api.qrserver.com/v1/create-qr-code/?size=220x220&data=QRIS-FAKE-1234567890" alt="QRIS Barcode" />
        </div>
        <button onclick="window.location.href='{{ url('/order_success') }}'" class="btn-back" style="margin-top:2em;">Saya Sudah Bayar</button>
    </div>
</body>
</html>
