<div id="purchase-form-modal" class="fixed inset-0 bg-black bg-opacity-60 z-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-xl shadow-xl p-8 max-w-md w-full relative">
        <button id="close-purchase-modal" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
        <h2 class="text-2xl font-bold mb-6 text-center">Proceder a la compra</h2>
        <div id="paypal-button-container-modal"></div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('purchase-form-modal');
        const closeBtn = document.getElementById('close-purchase-modal');
        if (closeBtn) {
            closeBtn.onclick = () => {
                modal.classList.add('hidden');
            };
        }
    });
</script>
