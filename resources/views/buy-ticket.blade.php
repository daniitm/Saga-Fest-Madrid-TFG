<x-app-layout>
    @if(($qtyGeneral ?? 0) < 5 || ($qtyPremium ?? 0) < 5)
        <section class="bg-white py-14 sm:py-20 lg:py-22" style="background-color: #111215;">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8 flex justify-center">
                <div class="bg-gray-50 rounded-2xl p-8 sm:p-10 shadow-2xl w-full max-w-md" style="background-color: #363636;">
                    <h1 class="text-4xl sm:text-5xl font-bold text-white mb-10 text-center">
                        No hay entradas disponibles
                    </h1>
                    <p class="text-lg text-center text-white">Le informamos de que actualmente no hay suficientes entradas disponibles para la venta.</p>
                    <p class="text-lg text-center text-white">Vuelvalo a intentar en unos minutos, en caso de que siga igual y crea que es un error no dude <a href="{{ route('contact') }}" class="underline" style="color: #7692FF;">contactar con nosotros</a>.</p>
                </div>
            </div>
        </section>
    @else
        <section class="bg-white py-14 sm:py-20 lg:py-22" style="background-color: #111215;">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-5xl">
                <div class="bg-gray-50 rounded-2xl p-10 sm:p-14 shadow-2xl" style="background-color: #363636;">
                    <h1 class="text-4xl sm:text-5xl font-bold text-white mb-10 text-center">
                        Comprar entradas
                    </h1>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                        <!-- Entrada General -->
                        <div class="bg-[#232323] rounded-xl p-8 flex flex-col items-center">
                            <h2 class="text-2xl font-bold text-white mb-2">General</h2>
                            <ul class="text-gray-300 text-sm mb-4 list-disc list-inside">
                                <li>Acceso a zona general</li>
                                <li>Asiento estándar</li>
                                <li>Acceso a todas las actividades</li>
                            </ul>
                            <div class="flex items-center gap-4 mb-4">
                                <button type="button" id="minus-general" class="bg-primary hover:bg-primary/80 text-white rounded-full w-8 h-8 flex items-center justify-center text-xl">-</button>
                                <span id="qty-general" class="text-2xl text-white font-bold">0</span>
                                <button type="button" id="plus-general" class="bg-primary hover:bg-primary/80 text-white rounded-full w-8 h-8 flex items-center justify-center text-xl">+</button>
                            </div>
                            <p class="text-lg text-white font-semibold">{{ number_format($generalPrice, 2) }} €</p>
                        </div>
                        <!-- Entrada Premium -->
                        <div class="bg-[#232323] rounded-xl p-8 flex flex-col items-center">
                            <h2 class="text-2xl font-bold text-white mb-2">Premium</h2>
                            <ul class="text-gray-300 text-sm mb-4 list-disc list-inside">
                                <li>Acceso a zona premium</li>
                                <li>Asiento preferente</li>
                                <li>Regalo exclusivo</li>
                            </ul>
                            <div class="flex items-center gap-4 mb-4">
                                <button type="button" id="minus-premium" class="bg-primary hover:bg-primary/80 text-white rounded-full w-8 h-8 flex items-center justify-center text-xl">-</button>
                                <span id="qty-premium" class="text-2xl text-white font-bold">0</span>
                                <button type="button" id="plus-premium" class="bg-primary hover:bg-primary/80 text-white rounded-full w-8 h-8 flex items-center justify-center text-xl">+</button>
                            </div>
                            <p class="text-lg text-white font-semibold">{{ number_format($premiumPrice, 2) }} €</p>
                        </div>
                    </div>
                    <div class="mt-10 flex flex-col items-center">
                        <p class="text-white text-lg mb-4">Total: <span id="total-amount">0.00</span> €</p>
                        <div class="flex flex-col gap-3 mb-6 w-full max-w-md bg-[#232323] rounded-xl p-6">
                            <label class="flex items-start gap-3 cursor-pointer select-none">
                                <input type="checkbox" id="over14" class="accent-primary mt-1 scale-125" />
                                <span class="text-white text-base leading-snug">Admito tener más de 14 años y ser responsable de mi compra.</span>
                            </label>
                            <label class="flex items-start gap-3 cursor-pointer select-none">
                                <input type="checkbox" id="accept-terms" class="accent-primary mt-1 scale-125" />
                                <span class="text-white text-base leading-snug">Acepto las condiciones de compra dadas en los <a href='{{ route('terms-conditions') }}' target="_blank" class="underline text-blue-400 hover:text-blue-300 transition">términos y condiciones</a>.</span>
                            </label>
                        </div>
                        <button id="buy-btn" class="bg-primary hover:bg-primary/80 text-white px-8 py-3 rounded-full font-bold text-lg disabled:opacity-50" disabled>Comprar entradas</button>
                        {{-- Modal para compra --}}
                        @include('components.purchase-form')
                    </div>
                </div>
            </div>
        </section>
        <script src="https://www.paypal.com/sdk/js?client-id={{ $paypalClientId }}&currency=EUR"></script>
        <script>
            const prices = {
                General: parseFloat("{{ number_format($generalPrice ?? 0, 2, '.', '') }}"),
                Premium: parseFloat("{{ number_format($premiumPrice ?? 0, 2, '.', '') }}")
            };
            let qtyGeneral = 0;
            let qtyPremium = 0;
            let maxAvailable = 5;
            function updateTotal() {
                const total = qtyGeneral + qtyPremium;
                document.getElementById('total-amount').textContent = (qtyGeneral * prices.General + qtyPremium * prices.Premium).toFixed(2);
                checkFormReady();
                document.getElementById('plus-general').disabled = total >= 5;
                document.getElementById('plus-premium').disabled = total >= 5;
            }
            function checkFormReady() {
                const over14 = document.getElementById('over14').checked;
                const acceptTerms = document.getElementById('accept-terms').checked;
                const total = qtyGeneral + qtyPremium;
                document.getElementById('buy-btn').disabled = !(total > 0 && over14 && acceptTerms);
            }
            document.getElementById('plus-general').onclick = function() {
                if (qtyGeneral + qtyPremium < 5) {
                    qtyGeneral++;
                    document.getElementById('qty-general').textContent = qtyGeneral;
                    updateTotal();
                }
            };
            document.getElementById('plus-premium').onclick = function() {
                if (qtyGeneral + qtyPremium < 5) {
                    qtyPremium++;
                    document.getElementById('qty-premium').textContent = qtyPremium;
                    updateTotal();
                }
            };
            document.getElementById('minus-general').onclick = function() {
                if (qtyGeneral > 0) qtyGeneral--;
                document.getElementById('qty-general').textContent = qtyGeneral;
                updateTotal();
            };
            document.getElementById('minus-premium').onclick = function() {
                if (qtyPremium > 0) qtyPremium--;
                document.getElementById('qty-premium').textContent = qtyPremium;
                updateTotal();
            };
            document.getElementById('buy-btn').onclick = function() {
                // Mostrar el modal
                document.getElementById('purchase-form-modal').classList.remove('hidden');
                // Renderizar los botones de PayPal en el modal solo si no están ya
                if (!document.getElementById('paypal-button-container-modal').hasChildNodes()) {
                    paypal.Buttons({
                        createOrder: function(data, actions) {
                            const total = (qtyGeneral * prices.General) + (qtyPremium * prices.Premium);
                            return actions.order.create({
                                purchase_units: [{
                                    amount: {
                                        value: total.toFixed(2)
                                    }
                                }]
                            });
                        },
                        onApprove: function(data, actions) {
                            return actions.order.capture().then(function(details) {
                                fetch("{{ route('purchase.store') }}", {
                                    method: "POST",
                                    headers: {
                                        "Content-Type": "application/json",
                                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                                    },
                                    body: JSON.stringify({
                                        orderID: data.orderID,
                                        general_qty: qtyGeneral,
                                        premium_qty: qtyPremium,
                                        amount: ((qtyGeneral * prices.General) + (qtyPremium * prices.Premium)).toFixed(2)
                                    })
                                })
                                .then(res => res.json())
                                .then(data => {
                                    if (data.reload) {
                                        window.location.reload();
                                    }
                                });
                            });
                        }
                    }).render('#paypal-button-container-modal');
                }
            };
            fetch("/api/user/tickets-remaining", {
                headers: {"X-Requested-With": "XMLHttpRequest"}
            })
            .then(res => res.json())
            .then(data => {
                if (data && typeof data.remaining === 'number') {
                    maxAvailable = data.remaining;
                    updateTotal();
                    if (maxAvailable === 0) {
                        showMaxTicketsMessage();
                    }
                }
            });
            ['over14', 'accept-terms'].forEach(id => {
                document.getElementById(id).addEventListener('change', checkFormReady);
            });
        </script>
    @endif
    <x-footer />
</x-app-layout>