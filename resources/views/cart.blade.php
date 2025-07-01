<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja - Meja {{ $tableNumber }}</title>
    <style>
        /* --- V3: WOW & RESPONSIVE DESIGN --- */

        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');

        /* Definisi animasi Keyframes */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes pulse {
            0% { transform: scale(1); box-shadow: 0 4px 15px rgba(255, 165, 0, 0.4); }
            50% { transform: scale(1.05); box-shadow: 0 7px 25px rgba(255, 165, 0, 0.6); }
            100% { transform: scale(1); box-shadow: 0 4px 15px rgba(255, 165, 0, 0.4); }
        }

        body {
            font-family: 'Poppins', system-ui, sans-serif;
            background: linear-gradient(170deg, #f5f7fa, #c3cfe2); /* Gradien latar belakang yang lembut */
            color: #333;
            line-height: 1.6;
            min-height: 100vh;
        }

        .container {
            max-width: 800px;
            margin: 2em auto;
            background: rgba(255, 255, 255, 0.85); /* Latar belakang semi-transparan */
            backdrop-filter: blur(10px); /* Efek Glassmorphism */
            padding: 2em;
            border-radius: 16px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
        }

        h1 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 1.5em;
            font-weight: 700;
        }

        .cart-item {
            display: flex;
            align-items: center;
            margin-bottom: 1.5em;
            padding: 1.2em;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.5);
            border-bottom: 1px solid #e0e0e0;
            transition: all 0.3s ease;
            /* Terapkan animasi di sini */
            opacity: 0; /* Mulai dari transparan */
            animation: fadeInUp 0.5s ease forwards;
        }

        .cart-item:hover {
            transform: scale(1.03);
            background: rgba(255, 255, 255, 1);
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }

        .cart-item img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 10px;
            margin-right: 1.5em;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .cart-item-details { flex-grow: 1; }
        .cart-item-details strong { font-size: 1.1em; font-weight: 600; color: #34495e; }
        .cart-item-details p { margin: 0.3em 0 0; font-weight: 600; color: #e67e22; }
        .cart-item-notes { font-size: 0.9em; color: #7f8c8d; margin-top: 0.5em; font-style: italic; }

        .item-actions { display: flex; align-items: center; }
        
        .qty-control {
            display: flex;
            align-items: center;
            margin-right: 2em;
            background-color: #f0f2f5;
            border-radius: 20px;
            padding: 0.3em;
            box-shadow: inset 0 1px 3px rgba(0,0,0,0.06);
        }
        
        .qty-btn {
            border: none;
            background: white;
            cursor: pointer;
            color: #333;
            border-radius: 50%;
            width: 32px;
            height: 32px;
            font-size: 1.3em;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .qty-btn:hover { background-color: #e67e22; color: white; }
        .qty-btn:active { transform: scale(0.9); }
        .qty-control span { padding: 0 1.2em; font-weight: 600; font-size: 1.1em; }

        .remove-btn {
            color: #e74c3c;
            cursor: pointer;
            font-weight: 600;
            font-size: 0.9em;
            padding: 0.5em 1em;
            border-radius: 20px;
            transition: all 0.2s ease;
        }
        .remove-btn:hover { background-color: #e74c3c; color: white; transform: scale(1.05); }

        .cart-footer {
            margin-top: 2em;
            border-top: 2px solid #e67e22;
            padding-top: 1.5em;
            text-align: right;
        }
        
        .cart-footer h2 { font-size: 1.8em; font-weight: 700; color: #2c3e50; }
        .cart-footer h2 span { color: #e67e22; }
        
        .btn-checkout {
            display: inline-block;
            padding: 0.9em 2.8em;
            background: linear-gradient(45deg, #e67e22, #f39c12);
            color: white;
            text-align: center;
            border: none;
            border-radius: 50px;
            font-size: 1.2em;
            font-weight: 600;
            text-decoration: none;
            margin-top: 1em;
            box-shadow: 0 4px 15px rgba(230, 126, 34, 0.4);
            transition: all 0.3s ease;
            animation: pulse 2.5s infinite; /* Animasi berdenyut untuk menarik perhatian */
        }
        .btn-checkout:hover {
            transform: translateY(-5px);
            box-shadow: 0 7px 20px rgba(230, 126, 34, 0.6);
            animation-play-state: paused; /* Hentikan animasi denyut saat di-hover */
        }
        
        .back-link {
            display: block; text-align: center; margin-top: 2em; color: #7f8c8d;
            text-decoration: none; font-weight: 600; transition: color 0.2s ease;
        }
        .back-link:hover { color: #e67e22; }
        .empty-cart-message { text-align: center; padding: 3em 1em; color: #7f8c8d; font-size: 1.1em; }

        /* --- MOBILE RESPONSIVE DESIGN --- */
        @media screen and (max-width: 768px) {
            body { margin: 0; }
            .container {
                margin: 0;
                padding: 1em;
                border-radius: 0;
                min-height: 100vh;
                box-shadow: none;
            }

            h1 { font-size: 1.5em; }

            .cart-item {
                flex-direction: column; /* Tumpuk item secara vertikal */
                align-items: flex-start;
                position: relative;
            }

            .cart-item img { margin-bottom: 1em; }

            .item-actions {
                width: 100%;
                margin-top: 1em;
                justify-content: space-between; /* Posisikan kontrol qty & hapus berjauhan */
            }

            .qty-control { margin-right: 0; }

            .cart-footer { text-align: center; }
            .cart-footer h2 { font-size: 1.5em; }
            
            .btn-checkout {
                width: 100%; /* Tombol checkout menjadi lebar penuh */
                padding: 1em;
                font-size: 1.1em;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Keranjang Anda (Meja {{ $tableNumber }})</h1>
        <div id="cart-items-container">
            <p class="empty-cart-message">Memuat keranjang...</p>
        </div>
        <div class="cart-footer">
            <h2>Total: <span id="total-price">Rp 0</span></h2>
            <a href="#" id="checkout-link" class="btn-checkout" style="display:none;">Lanjut ke Pembayaran</a>
        </div>
        <a href="{{ route('order.index', ['tableNumber' => $tableNumber]) }}" class="back-link">&larr; Kembali ke Menu</a>
    </div>

    <script type="module">
        const cartKey = `cart_meja_{{ $tableNumber }}`;
        let cart = JSON.parse(localStorage.getItem(cartKey)) || [];

        function renderCart() {
            const container = document.getElementById('cart-items-container');
            const checkoutLink = document.getElementById('checkout-link');
            
            if (cart.length === 0) {
                container.innerHTML = '<p class="empty-cart-message">Keranjang Anda kosong.</p>';
                checkoutLink.style.display = 'none';
                document.getElementById('total-price').innerText = 'Rp 0';
                return;
            }

            container.innerHTML = '';
            let totalPrice = 0;
            const itemElements = []; // Tampung elemen sebelum dimasukkan ke DOM

            cart.forEach((item, index) => {
                totalPrice += item.price * item.quantity;
                const itemElement = document.createElement('div');
                itemElement.className = 'cart-item';
                // Set animation delay untuk efek staggered
                itemElement.style.animationDelay = `${index * 100}ms`;

                itemElement.innerHTML = `
                    <img src="${item.image_path ? '/storage/' + item.image_path : 'https://via.placeholder.com/80'}" alt="${item.name}">
                    <div class="cart-item-details">
                        <strong>${item.name}</strong>
                        <p>Rp ${Number(item.price).toLocaleString('id-ID')}</p>
                        ${item.notes ? `<p class="cart-item-notes">Catatan: ${item.notes}</p>` : ''}
                    </div>
                    <div class="item-actions">
                        <div class="qty-control">
                            <button class="qty-btn" onclick="updateQuantity(${index}, -1)">-</button>
                            <span>${item.quantity}</span>
                            <button class="qty-btn" onclick="updateQuantity(${index}, 1)">+</button>
                        </div>
                        <span class="remove-btn" onclick="removeItem(${index})">Hapus</span>
                    </div>
                `;
                // Jangan langsung append, kumpulkan dulu
                itemElements.push(itemElement);
            });

            // Append semua elemen sekaligus untuk performa lebih baik
            itemElements.forEach(el => container.appendChild(el));

            document.getElementById('total-price').innerText = `Rp ${totalPrice.toLocaleString('id-ID')}`;
            checkoutLink.style.display = 'inline-block';
            checkoutLink.href = `{{ route('order.checkout') }}?tableNumber={{ $tableNumber }}&cart=${encodeURIComponent(JSON.stringify(cart))}`;
        }
        
        window.updateQuantity = function(index, amount) {
            cart[index].quantity += amount;
            if (cart[index].quantity <= 0) {
                cart.splice(index, 1);
            }
            saveCart();
            renderCart();
        }

        window.removeItem = function(index) {
            if(confirm('Anda yakin ingin menghapus item ini dari keranjang?')) {
                cart.splice(index, 1);
                saveCart();
                renderCart();
            }
        }

        function saveCart() {
            localStorage.setItem(cartKey, JSON.stringify(cart));
        }

        document.addEventListener('DOMContentLoaded', renderCart);
    </script>
</body>
</html>