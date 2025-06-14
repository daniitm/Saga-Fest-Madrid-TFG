<x-app-layout>
    <section class="bg-white py-14 sm:py-20 lg:py-22" style="background-color: #111215;">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-5xl">
            <div class="bg-gray-50 rounded-2xl p-10 sm:p-14 shadow-2xl" style="background-color: #363636;">
                <h1 class="text-4xl sm:text-5xl font-bold text-white mb-10 text-center">
                    Mis Entradas
                </h1>
                @if($tickets->isEmpty())
                    <p class="text-lg text-center text-white">Aún no has comprado entradas.</p>                
                @else
                    <div class="space-y-6">
                        @foreach($tickets as $purchase)
                            <div class="bg-[#232323] rounded-xl p-8 flex flex-col sm:flex-row sm:items-center sm:justify-between shadow-lg">
                                <div>
                                    <div class="text-white text-xl font-semibold mb-1">{{ $purchase->ticket->type }} Entrada</div>
                                    <div class="text-gray-400 text-sm">Comprada el {{ $purchase->created_at->format('d/m/Y H:i') }}</div>
                                </div>
                                <div class="text-white text-2xl font-bold mt-4 sm:mt-0">
                                    {{ number_format($purchase->amount, 2) }} €
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </section>
    <x-footer />
</x-app-layout>