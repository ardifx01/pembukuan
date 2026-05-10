<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
                    Transaksi Penjualan
                </h2>

                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                    Proses transaksi penjualan produk
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                <!-- ===================================================== -->
                <!-- PANEL CARI PRODUK -->
                <!-- ===================================================== -->

                <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-md border border-gray-100 dark:border-gray-800 overflow-hidden">

                    <div class="px-5 py-4 bg-gradient-to-r from-gray-50 to-white dark:from-gray-900 dark:to-gray-900 border-b border-gray-100 dark:border-gray-800">

                        <div class="flex items-center gap-2">

                            <div class="p-2 bg-blue-100 dark:bg-blue-900/30 rounded-lg">

                                <svg class="w-5 h-5 text-blue-600"
                                     fill="none"
                                     stroke="currentColor"
                                     viewBox="0 0 24 24">

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="2"
                                          d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>

                                </svg>

                            </div>

                            <div>

                                <h3 class="font-semibold text-gray-800 dark:text-black">
                                    Cari Produk
                                </h3>

                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    Ketik nama atau kode produk
                                </p>

                            </div>

                        </div>

                    </div>

                    <div class="p-5">

                        <!-- SEARCH -->
                        <div class="relative">

                            <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-4 h-4 text-gray-400"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>

                            </svg>

                            <input
                                type="text"
                                id="searchProduct"
                                placeholder="Cari produk..."
                                autocomplete="off"
                                class="w-full pl-10 pr-4 py-2.5 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:text-white">

                        </div>

                        <!-- RESULTS -->
                        <div id="searchResults"
                             class="mt-4 hidden">

                            <div id="searchCount"
                                 class="text-xs text-gray-500 mb-2">
                            </div>

                            <div id="resultsList"
                                 class="space-y-2 max-h-96 overflow-y-auto">
                            </div>

                        </div>

                        <!-- LOADING -->
                        <div id="loading"
                             class="text-center py-8 hidden">

                            <div class="inline-block w-6 h-6 border-2 border-blue-500 border-t-transparent rounded-full animate-spin">
                            </div>

                            <p class="text-sm text-gray-400 mt-2">
                                Mencari...
                            </p>

                        </div>

                        <!-- NO RESULTS -->
                        <div id="noResults"
                             class="text-center py-8 hidden">

                            <p class="text-gray-400">
                                Produk tidak ditemukan
                            </p>

                        </div>

                        <!-- INITIAL -->
                        <div id="initialMessage"
                             class="text-center py-8">

                            <p class="text-gray-400">
                                Ketik minimal 2 karakter untuk mencari produk
                            </p>

                        </div>

                    </div>

                </div>

                <!-- ===================================================== -->
                <!-- PANEL KERANJANG -->
                <!-- ===================================================== -->

                <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-md border border-gray-100 dark:border-gray-800 overflow-hidden">

                    <!-- HEADER -->
                    <div class="px-5 py-4 bg-gradient-to-r from-gray-50 to-white dark:from-gray-900 dark:to-gray-900 border-b border-gray-100 dark:border-gray-800">

                        <div class="flex items-center justify-between">

                            <div class="flex items-center gap-2">

                                <div class="p-2 bg-green-100 dark:bg-green-900/30 rounded-lg">

                                    <svg class="w-5 h-5 text-green-600"
                                         fill="none"
                                         stroke="currentColor"
                                         viewBox="0 0 24 24">

                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              stroke-width="2"
                                              d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-1.5 6.5M17 13l1.5 6.5M9 21h6M12 18v3"></path>

                                    </svg>

                                </div>

                                <div>

                                    <h3 class="font-semibold text-gray-800 dark:text-black">
                                        Keranjang Belanja
                                    </h3>

                                    <p class="text-xs text-gray-500 dark:text-gray-400">
                                        Daftar produk yang akan dibeli
                                    </p>

                                </div>

                            </div>

                            <span id="cartCount"
                                  class="text-xs bg-blue-100 text-blue-600 px-2.5 py-1 rounded-full font-medium">

                                0 item
                            </span>

                        </div>

                    </div>

                    <!-- BODY -->
                    <div class="p-5">

                        <!-- ITEMS -->
                        <div id="cartItems"class="max-h-96 overflow-y-auto space-y-2 mb-4">
                        </div>

                        <!-- TOTAL -->
                        <div class="border-t border-gray-100 dark:border-gray-800 pt-4">

                            <div class="flex justify-between items-center mb-4">

                                <span class="text-gray-600 dark:text-gray-300">
                                    Total Belanja
                                </span>

                                <span id="cartTotal"
                                      class="text-2xl font-bold text-green-600">

                                    Rp 0
                                </span>

                            </div>

                            <!-- DISKON -->
<div class="mb-4">

    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">

        Diskon / Potongan Harga
    </label>

    <!-- INPUT TAMPILAN -->
    <input
        type="text"
        id="discount"
        placeholder="0"
        class="w-full px-4 py-3 rounded-2xl border border-gray-200 dark:border-gray-700
               dark:bg-gray-900 dark:text-white">

</div>

                            </div>

                            <!-- GRAND TOTAL -->
                            <div class="flex justify-between items-center mb-4">

                                <span class="text-gray-600 dark:text-gray-300">
                                    Total Setelah Diskon
                                </span>

                                <span id="grandTotal"
                                      class="text-2xl font-bold text-blue-600">

                                    Rp 0
                                </span>

                            </div>

                            <!-- FORM -->
                            <form action="{{ route('transactions.store') }}"
                                  method="POST"
                                  id="transactionForm">

                                @csrf
                                
                                <input type="hidden"
                                        name="discount"
                                        id="discount_input"
                                        value="0">
                                        
                                <!-- CUSTOMER -->
                                <div class="mb-3">

                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">

                                        Nama Pelanggan
                                    </label>

                                    <input
                                        type="text"
                                        name="customer_name"
                                        placeholder="Masukkan nama pelanggan"
                                        class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:text-white">

                                </div>


                                <!-- PAYMENT METHOD -->
<div class="mb-3">

    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
        Metode Pembayaran
    </label>

    <select
        name="payment_method"
        id="payment_method"
        class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-800
               border border-gray-200 dark:border-gray-700
               rounded-xl focus:ring-2 focus:ring-blue-500
               focus:border-transparent dark:text-white">

        <option value="cash">Tunai</option>

        <option value="transfer">Transfer Bank</option>

        <option value="qris">QRIS</option>

        <option value="dp">DP / Cicilan</option>

        <option value="credit_card">Credit Card</option>

    </select>

</div>

<!-- DP AMOUNT -->
<div class="mb-3 hidden" id="dpContainer">

    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
        Jumlah DP
    </label>

    <input
        type="text"
        name="dp_amount"
        id="dp_amount"
        placeholder="0"
        class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-800
               border border-gray-200 dark:border-gray-700
               rounded-xl focus:ring-2 focus:ring-blue-500
               focus:border-transparent dark:text-white">

</div>

<!-- JUMLAH BAYAR -->
<div class="mb-3" id="paidContainer">

    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
        Jumlah Bayar
    </label>

    <input
        type="text"
        name="paid"
        id="paid"
        required
        placeholder="0"
        class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-800
               border border-gray-200 dark:border-gray-700
               rounded-xl focus:ring-2 focus:ring-blue-500
               focus:border-transparent dark:text-white">

</div>


                                <!-- CHANGE -->
                                <div id="changeAmount"
                                     class="text-right text-sm mb-3 font-medium">
                                </div>

                                <!-- HIDDEN -->
                                <input type="hidden"
                                       name="items"
                                       id="itemsInput">

                                <input type="hidden"
                                       name="discount_raw"
                                       id="discountRaw">

                                <!-- BUTTON -->
                                <button type="submit"
                                        class="w-full bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white font-semibold py-3 rounded-xl transition shadow-md hover:shadow-lg">

                                    Proses Transaksi
                                </button>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

<script>

    let cart = @json($cart);
    let allProducts = @json($furniture);

    const searchInput = document.getElementById('searchProduct');
    const searchResults = document.getElementById('searchResults');
    const resultsList = document.getElementById('resultsList');
    const loading = document.getElementById('loading');
    const noResults = document.getElementById('noResults');
    const searchCount = document.getElementById('searchCount');
    const initialMessage = document.getElementById('initialMessage');

    const discountInput = document.getElementById('discount');
    const paidInput = document.getElementById('paid');
    const paymentMethod = document.getElementById('payment_method');
    const dpContainer = document.getElementById('dpContainer');
    const paidContainer = document.getElementById('paidContainer');
    const dpInput = document.getElementById('dp_amount');

    // =====================================================
    // FORMAT
    // =====================================================

    function formatRupiah(value) {

        value = value.toString().replace(/[^0-9]/g, '');

        return new Intl.NumberFormat('id-ID')
            .format(value);
    }

    function parseRupiah(value) {

        return parseInt(
            value.toString().replace(/[^0-9]/g, '')
        ) || 0;
    }

    function formatNumber(num) {

        return num.toString().replace(
            /\B(?=(\d{3})+(?!\d))/g,
            "."
        );
    }

    // =====================================================
    // ESCAPE HTML
    // =====================================================

    function escapeHtml(str) {

        if (!str) return '';

        return str.replace(/[&<>]/g, function(m) {

            if (m === '&') return '&amp;';
            if (m === '<') return '&lt;';
            if (m === '>') return '&gt;';

            return m;
        });
    }

    // =====================================================
    // ADD TO CART
    // =====================================================

    function addToCart(id, quantity) {

        window.location.href =
            '/transactions/add-to-cart/' +
            id +
            '/' +
            quantity;
    }

    // =====================================================
    // CALCULATE
    // =====================================================

    function calculateTransaction() {const totalText =
            document.getElementById('cartTotal').innerText;

        const total =
            parseRupiah(totalText);

        const discount =
            parseRupiah(discountInput.value);

        const grandTotal =
            Math.max(total - discount, 0);

        document.getElementById('grandTotal').innerHTML ='Rp ' + formatRupiah(grandTotal.toString());

        const paid =
            parseRupiah(paidInput.value);

        const change =
            paid - grandTotal;

        const changeDiv =
            document.getElementById('changeAmount');

        if (change >= 0) {

            changeDiv.innerHTML =
                `Kembalian: Rp ${formatRupiah(change.toString())}`;

            changeDiv.className =
                'text-right text-sm mb-3 font-medium text-green-600';

        } else {

            changeDiv.innerHTML =
                `Kurang: Rp ${formatRupiah(Math.abs(change).toString())}`;

            changeDiv.className =
                'text-right text-sm mb-3 font-medium text-red-600';
        }
    }

    // =====================================================
    // UPDATE CART
    // =====================================================

    function updateCartDisplay() {

        const cartContainer =
            document.getElementById('cartItems');

        let total = 0;
        let itemCount = 0;

        if (Object.keys(cart).length === 0) {

            cartContainer.innerHTML = `
                <div class="text-center py-10">
                    <p class="text-gray-400">
                        Keranjang kosong
                    </p>
                </div>
            `;

            document.getElementById('cartTotal').innerHTML =
                'Rp 0';

            document.getElementById('cartCount').innerHTML =
                '0 item';

            calculateTransaction();

            return;
        }

        let html = '<div class="space-y-3">';

        for (let id in cart) {

            const item = cart[id];

            let qty =
                parseInt(item.quantity);

            if (isNaN(qty)) qty = 1;

            const subtotal =
                parseFloat(item.price) * qty;

            total += subtotal;

            itemCount += qty;

           html += `
    <div class="bg-gray-50 dark:bg-gray-800 rounded-xl p-3 hover:shadow-sm transition">

        <div class="flex gap-3">

            <div class="flex-shrink-0">

                ${
                    item.image
                    ? `<img src="/${item.image}"
                            class="w-14 h-14 rounded-xl object-cover border border-gray-200 dark:border-gray-700">`
                    : `<div class="w-14 h-14 rounded-xl bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-xl">
                            🪑
                       </div>`
                }

            </div>

            <div class="flex-1">

                <div class="flex justify-between items-start">

                    <div>

                        <h4 class="font-semibold text-black dark:text-black">
                            ${escapeHtml(item.name)}
                        </h4>

                        <p class="text-xs text-gray-500 mt-1">
                            Rp ${formatNumber(item.price)}
                        </p>

                    </div>

                    <div class="text-right">

                        <p class="font-bold text-green-600">
                            Rp ${formatNumber(subtotal)}
                        </p>

                        <a href="/transactions/remove-from-cart/${id}"
                           class="text-red-500 text-xs mt-1 inline-block">

                            Hapus
                        </a>

                    </div>

                </div>

                <div class="flex items-center gap-3 mt-3">

                    <a href="/transactions/add-to-cart/${id}/-1"
                       class="w-7 h-7 rounded-full bg-gray-200 dark:bg-green flex items-center justify-center">

                        -
                    </a>

                    <span class="font-semibold dark:text-black">
                        ${item.quantity}
                    </span>

                    <a href="/transactions/add-to-cart/${id}/1"
                       class="w-7 h-7 rounded-full bg-gray-200 dark:bg-green flex items-center justify-center">

                        +
                    </a>

                </div>

            </div>

        </div>

    </div>
`;
        }

        html += '</div>';

        cartContainer.innerHTML = html;

        document.getElementById('cartTotal').innerHTML =
            'Rp ' + formatNumber(total);

        document.getElementById('cartCount').innerHTML =
            itemCount + ' item';

        calculateTransaction();
    }

    // =====================================================
    // FORMAT DISKON
    // =====================================================

    discountInput.addEventListener('input', function(e) {

    let number =
        parseRupiah(e.target.value);

    // FORMAT INPUT
    e.target.value =
        formatRupiah(number.toString());

    // KIRIM KE BACKEND
    document.getElementById('discount_input').value =
        number;

    calculateTransaction();
});

    // =====================================================
    // FORMAT BAYAR
    // =====================================================

    paidInput.addEventListener('input', function(e) {

        let number =
            parseRupiah(e.target.value);

        e.target.value =
            formatRupiah(number.toString());

        calculateTransaction();
    });

    // =====================================================
    // SEARCH
    // =====================================================

    // =====================================================
// DP PAYMENT
// =====================================================

paymentMethod.addEventListener('change', function() {

    if (this.value === 'dp') {

        // TAMPILKAN DP
        dpContainer.classList.remove('hidden');

        // SEMBUNYIKAN BAYAR
        paidContainer.classList.add('hidden');

        // HAPUS REQUIRED
        paidInput.removeAttribute('required');

        // KOSONGKAN BAYAR
        paidInput.value = '';

    } else {

        // HIDE DP
        dpContainer.classList.add('hidden');

        // TAMPILKAN BAYAR
        paidContainer.classList.remove('hidden');

        // BALIKKAN REQUIRED
        paidInput.setAttribute('required', true);
    }
});

// FORMAT DP
dpInput.addEventListener('input', function(e) {

    let number =
        parseRupiah(e.target.value);

    e.target.value =
        formatRupiah(number.toString());
});
    searchInput.addEventListener('input', function() {

        const query =
            this.value.toLowerCase().trim();

        initialMessage.classList.add('hidden');

        if (query.length < 2) {

            searchResults.classList.add('hidden');

            return;
        }

        searchResults.classList.remove('hidden');

        const filtered = allProducts.filter(p =>

            p.name.toLowerCase().includes(query) ||

            (p.code &&
                p.code.toLowerCase().includes(query))
        );

        searchCount.textContent =
            `Ditemukan ${filtered.length} produk`;

        resultsList.innerHTML = filtered.map(p => `

    <div class="bg-gray-50 dark:bg-gray-800 rounded-xl p-3 hover:shadow-sm transition">

        <div class="flex gap-3">

            <div class="flex-shrink-0">

                ${
                    p.image
                    ? `<img src="${p.image}"
                            class="w-14 h-14 rounded-xl object-cover border border-gray-200 dark:border-gray-700">`
                    : `<div class="w-14 h-14 rounded-xl bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-xl">
                            🪑
                       </div>`
                }

            </div>

            <div class="flex-1">

                <div class="flex justify-between items-start">

                    <div>

                        <h4 class="font-semibold text-gray-800 dark:text-black">
                            ${escapeHtml(p.name)}
                        </h4>

                        <p class="text-xs text-gray-500">
                            ${escapeHtml(p.code || '-')}
                        </p>

                        <p class="text-green-600 font-bold mt-1">
                            Rp ${formatNumber(p.selling_price)}
                        </p>

                    </div>

                    <div class="text-right">

                        <p class="text-xs text-gray-500">
                            Stok: ${p.stock}
                        </p>

                    </div>

                </div>

                <div class="flex items-center gap-2 mt-3">

                    <input type="number"
                           id="qty_${p.id}"
                           value="1"
                           min="1"max="${p.stock}"class="w-16 px-2 py-1 border border-gray-200 dark:border-gray-700 rounded-lg text-center text-sm dark:bg-gray-900 dark:text-white">

                    <button
                        onclick="addToCart(${p.id}, document.getElementById('qty_${p.id}').value)"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded-lg text-sm">

                        Tambah
                    </button>

                </div>

            </div>

        </div>

    </div>

`).join('');
    });

    // INIT
    updateCartDisplay();

</script>
</x-app-layout>