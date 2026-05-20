@extends('layouts.layout')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/store.css') }}">
@endpush

@section('content')

<!-- Loader -->
<div class="loader-overlay" id="loader" style="display: none;">
    <div class="basketball-loader"></div>
</div>

<!-- Tienda Principal -->
<div class="store-container" id="app-content" style="display: block;">
    <header class="store-header">
        <div class="store-title">Kuroko Store</div>
        <div class="cart-icon-wrapper" onclick="toggleCart()">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="9" cy="21" r="1"></circle>
                <circle cx="20" cy="21" r="1"></circle>
                <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
            </svg>
            <div class="cart-badge" id="cart-count">0</div>
        </div>
    </header>

    <main>
        <div class="products-grid" id="products-grid">
            <!-- Productos renderizados por JS -->
        </div>
    </main>

    <!-- Modal del Carrito -->
    <div class="modal-overlay" id="cart-modal">
        <div class="modal-content">
            <button class="modal-close" onclick="toggleCart()">&times;</button>
            <h2 style="font-size: 2rem; font-weight: 800; color: var(--azul-oscuro); margin-bottom: 20px;">Tu Carrito</h2>
            
            <div id="cart-items">
                <!-- Items del carrito -->
            </div>

            <div class="cart-summary" id="cart-summary" style="display: none;">
                <div class="summary-row">
                    <span>Subtotal:</span>
                    <span id="cart-subtotal">$0.00</span>
                </div>
                <div class="summary-row">
                    <span>Impuestos (10%):</span>
                    <span id="cart-tax">$0.00</span>
                </div>
                <div class="summary-total">
                    <span>Total:</span>
                    <span id="cart-total">$0.00</span>
                </div>

                <button class="btn-buy" style="margin-top: 20px;" onclick="showCheckout()">Finalizar Pedido</button>
            </div>

            <div id="empty-cart-msg" style="text-align: center; color: var(--texto-oscuro); padding: 30px;">
                Tu carrito está vacío. ¡Agrega mercancía de tu equipo favorito!
            </div>

            <!-- Formulario de Checkout (Oculto inicialmente) -->
            <div class="checkout-section" id="checkout-section">
                <h3 style="color: var(--azul-oscuro); margin-bottom: 15px;">Datos de Envío</h3>
                <div class="form-grid">
                    <div class="form-group"><input type="text" id="chk-name" placeholder="Nombre completo" required></div>
                    <div class="form-group"><input type="text" id="chk-phone" placeholder="Teléfono" required></div>
                    <div class="form-group"><input type="text" id="chk-country" placeholder="País" required></div>
                    <div class="form-group"><input type="text" id="chk-city" placeholder="Ciudad" required></div>
                    <div class="form-group full"><input type="text" id="chk-address" placeholder="Dirección de entrega" required></div>
                    <div class="form-group"><input type="text" id="chk-zip" placeholder="Código Postal"></div>
                    <div class="form-group"><input type="text" id="chk-ref" placeholder="Referencias (Opcional)"></div>
                </div>

                <h3 style="color: var(--azul-oscuro); margin-bottom: 15px; margin-top: 20px;">Método de Pago</h3>
                <div class="form-grid">
                    <div class="form-group full">
                        <select id="payment-method" onchange="toggleCardDetails()">
                            <option value="card">Tarjeta de Crédito / Débito</option>
                            <option value="paypal">PayPal</option>
                            <option value="transfer">Transferencia Bancaria</option>
                            <option value="cash">Contra entrega</option>
                        </select>
                    </div>
                </div>

                <div class="form-grid" id="card-details">
                    <div class="form-group full"><input type="text" placeholder="Número de Tarjeta" maxlength="19"></div>
                    <div class="form-group full"><input type="text" placeholder="Nombre del Titular"></div>
                    <div class="form-group"><input type="text" placeholder="MM/YY" maxlength="5"></div>
                    <div class="form-group"><input type="text" placeholder="CVV" maxlength="4"></div>
                </div>

                <button class="btn-buy" style="margin-top: 20px;" onclick="processOrder()">Confirmar Pago y Comprar</button>
            </div>
        </div>
    </div>
</div>

<!-- Notificación -->
<div class="notification" id="notification"></div>

<script>
    // Datos de los productos
    const products = [
        {
            id: 1,
            name: "Peluche Kuroko",
            description: "Peluche suave inspirado en Tetsuya Kuroko con uniforme Seirin. Diseño detallado estilo anime premium.",
            price: 25,
            stock: 15,
            image: "https://cdn.shopify.com/s/files/1/0445/3357/9943/products/suruga-ya_646087943001.jpg?v=1616374512"
        },
        {
            id: 2,
            name: "Peluche Kagami",
            description: "Peluche coleccionable inspirado en Taiga Kagami con uniforme oficial Seirin.",
            price: 28,
            stock: 10,
            image: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT3I5yYHI97YT2rsvgU8ifgPkxN7PmwuYL-FQ&s"
        },
        {
            id: 3,
            name: "Balón Seirin",
            description: "Balón profesional inspirado en el equipo Seirin High con acabado deportivo premium.",
            price: 40,
            stock: 8,
            image: "https://preview.free3d.com/img/2014/03/2272833730844296431/i7pqakxd.jpg"
        },
        {
            id: 4,
            name: "Balón Generation of Miracles",
            description: "Balón edición especial inspirado en la Generation of Miracles con diseño exclusivo anime.",
            price: 50,
            stock: 5,
            image: "https://miyagi.com.co/cdn/shop/files/balon-de-futbol-hybrido-molten-fn3101-cc-concacaff5n3101-cc-az-5056870_medium.png?v=1767988008"
        },
        {
            id: 5,
            name: "Poster Team Seirin",
            description: "Poster decorativo de alta calidad con los jugadores principales de Seirin.",
            price: 15,
            stock: 20,
            image: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT2lF7ArRLmqhcctQaRhCqPTwU1E8pNHunuqQ&s"
        },
        {
            id: 6,
            name: "Poster Generation of Miracles",
            description: "Poster premium con los integrantes de la Generation of Miracles en estilo épico.",
            price: 18,
            stock: 12,
            image: "https://i.pinimg.com/736x/61/a7/f0/61a7f0d98a7cfc9961715c304c17b879.jpg"
        },
        {
            id: 7,
            name: "Hoodie Seirin",
            description: "Sudadera estilo oversized inspirada en el uniforme de entrenamiento de Seirin.",
            price: 60,
            stock: 9,
            image: "https://fandomaniax-holidays.com/cdn/shop/products/kuroko-basketball-seirin-unisex-zipped-hoodie-435237.jpg?v=1700807536"
        },
        {
            id: 8,
            name: "Camiseta Kaijo",
            description: "Camiseta deportiva inspirada en Kaijo High con diseño moderno anime streetwear.",
            price: 35,
            stock: 14,
            image: "https://i.etsystatic.com/39592404/r/il/64e72c/4480850172/il_fullxfull.4480850172_kbh0.jpg"
        },
        {
            id: 9,
            name: "Tenis Kagami Zone",
            description: "Tenis deportivos inspirados en el modo Zone de Kagami con diseño futurista.",
            price: 120,
            stock: 6,
            image: "https://www.workshopcol.co/cdn/shop/products/image00013_b8807e19-2b92-458d-91b7-1016c59cba96.jpg?v=1678769852&width=1445"
        },
        {
            id: 10,
            name: "Tenis Aomine Street",
            description: "Tenis urbanos inspirados en Daiki Aomine con estilo callejero anime premium.",
            price: 130,
            stock: 4,
            image: "https://distriurbancolombia.com/wp-content/uploads/2024/02/WhatsApp-Image-2024-02-21-at-3.59.40-PM-2.jpeg"
        }
    ];

    // Estado del carrito
    let cart = JSON.parse(localStorage.getItem('kurokoCart')) || [];
    
    // Inicialización
    document.addEventListener('DOMContentLoaded', () => {
        renderProducts();
        updateCartBadge();
    });

    // Renderizar Productos
    function renderProducts() {
        const grid = document.getElementById('products-grid');
        if(!grid) return; 

        grid.innerHTML = '';
        products.forEach(p => {
            const card = document.createElement('div');
            card.className = 'product-card';
            card.innerHTML = `
                <img src="${p.image}" alt="${p.name}" class="product-image" onerror="this.src='https://via.placeholder.com/250x250?text=Imagen+No+Disponible'">
                <div class="product-info">
                    <div class="product-name">${p.name}</div>
                    <div class="product-desc">${p.description}</div>
                    <div class="product-meta">
                        <div class="product-price">$${p.price.toFixed(2)}</div>
                        <div class="product-stock">Stock: ${p.stock}</div>
                    </div>
                    <div class="product-actions">
                        <div class="qty-control">
                            <button class="qty-btn" onclick="changeQtyLocal(${p.id}, -1)">-</button>
                            <input type="text" class="qty-input" id="qty-${p.id}" value="1" readonly>
                            <button class="qty-btn" onclick="changeQtyLocal(${p.id}, 1, ${p.stock})">+</button>
                        </div>
                        <button class="btn-cart" onclick="addToCart(${p.id})">Agregar al carrito</button>
                        <button class="btn-buy" onclick="buyNow(${p.id})">Comprar ahora</button>
                    </div>
                </div>
            `;
            grid.appendChild(card);
        });
    }

    function changeQtyLocal(id, delta, maxStock = 99) {
        const input = document.getElementById(`qty-${id}`);
        let val = parseInt(input.value) + delta;
        if (val < 1) val = 1;
        if (val > maxStock) val = maxStock;
        input.value = val;
    }

    function addToCart(id, redirect = false) {
        const product = products.find(p => p.id === id);
        const qty = parseInt(document.getElementById(`qty-${id}`).value);
        
        const existing = cart.find(item => item.id === id);
        if (existing) {
            if (existing.qty + qty <= product.stock) {
                existing.qty += qty;
            } else {
                showNotification(`Stock máximo alcanzado para ${product.name}`);
                return;
            }
        } else {
            cart.push({ ...product, qty });
        }
        
        saveCart();
        showNotification(`${qty} x ${product.name} agregado(s)`);
        
        if (redirect) {
            toggleCart();
            showCheckout();
        }
    }

    function buyNow(id) {
        addToCart(id, true);
    }

    function saveCart() {
        localStorage.setItem('kurokoCart', JSON.stringify(cart));
        updateCartBadge();
        if (document.getElementById('cart-modal').style.display === 'flex') {
            renderCart();
        }
    }

    function updateCartBadge() {
        const count = cart.reduce((acc, item) => acc + item.qty, 0);
        const badge = document.getElementById('cart-count');
        if(badge) badge.innerText = count;
    }

    function toggleCart() {
        const modal = document.getElementById('cart-modal');
        if (modal.style.display === 'flex') {
            modal.style.display = 'none';
        } else {
            document.getElementById('checkout-section').style.display = 'none';
            renderCart();
            modal.style.display = 'flex';
        }
    }

    function renderCart() {
        const container = document.getElementById('cart-items');
        const summary = document.getElementById('cart-summary');
        const emptyMsg = document.getElementById('empty-cart-msg');
        
        container.innerHTML = '';
        
        if (cart.length === 0) {
            summary.style.display = 'none';
            emptyMsg.style.display = 'block';
            return;
        }
        
        emptyMsg.style.display = 'none';
        summary.style.display = 'block';
        
        let subtotal = 0;
        
        cart.forEach((item, index) => {
            subtotal += item.price * item.qty;
            const div = document.createElement('div');
            div.className = 'cart-item';
            div.innerHTML = `
                <img src="${item.image}" alt="${item.name}" onerror="this.src='https://via.placeholder.com/80x80?text=NA'">
                <div class="cart-item-info">
                    <div class="cart-item-title">${item.name}</div>
                    <div class="cart-item-price">$${item.price.toFixed(2)} c/u</div>
                </div>
                <div class="qty-control" style="border: none; background: transparent;">
                    <button class="qty-btn" onclick="updateCartQty(${index}, -1)">-</button>
                    <input type="text" class="qty-input" value="${item.qty}" readonly>
                    <button class="qty-btn" onclick="updateCartQty(${index}, 1)">+</button>
                </div>
                <button class="btn-remove" onclick="removeFromCart(${index})">Eliminar</button>
            `;
            container.appendChild(div);
        });
        
        const tax = subtotal * 0.10;
        const total = subtotal + tax;
        
        document.getElementById('cart-subtotal').innerText = `$${subtotal.toFixed(2)}`;
        document.getElementById('cart-tax').innerText = `$${tax.toFixed(2)}`;
        document.getElementById('cart-total').innerText = `$${total.toFixed(2)}`;
    }

    function updateCartQty(index, delta) {
        let newQty = cart[index].qty + delta;
        if (newQty < 1) newQty = 1;
        if (newQty > cart[index].stock) newQty = cart[index].stock;
        cart[index].qty = newQty;
        saveCart();
    }

    function removeFromCart(index) {
        cart.splice(index, 1);
        saveCart();
    }

    function showCheckout() {
        document.getElementById('checkout-section').style.display = 'block';
        // Scroll down
        const modalContent = document.querySelector('.modal-content');
        setTimeout(() => modalContent.scrollTop = modalContent.scrollHeight, 100);
    }

    function toggleCardDetails() {
        const method = document.getElementById('payment-method').value;
        document.getElementById('card-details').style.display = (method === 'card') ? 'grid' : 'none';
    }

    function processOrder() {
        // Validar campos básicos
        const required = ['chk-name', 'chk-phone', 'chk-address'];
        let valid = true;
        required.forEach(id => {
            if(!document.getElementById(id).value.trim()) valid = false;
        });

        if (!valid) {
            showNotification('Por favor completa los datos de envío requeridos', true);
            return;
        }

        // Simular procesamiento
        document.getElementById('loader').style.display = 'flex';
        toggleCart(); // Cerrar modal

        setTimeout(() => {
            document.getElementById('loader').style.display = 'none';
            cart = []; // Vaciar carrito
            saveCart();
            showNotification('¡Pedido confirmado! Tu orden está en camino 🏀✨');
        }, 2500);
    }

    function showNotification(msg, isError = false) {
        const notif = document.getElementById('notification');
        notif.innerText = msg;
        notif.style.background = isError ? '#d32f2f' : 'var(--azul-medio)';
        notif.classList.add('show');
        setTimeout(() => {
            notif.classList.remove('show');
        }, 3000);
    }
</script>
@endsection
