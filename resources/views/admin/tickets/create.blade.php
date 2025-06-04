<x-app-layout>
    <div class="py-8 sm:py-12 bg-gray-100 min-h-screen">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-xl border-2 border-[#7692FF] p-8">
                <h1 class="text-2xl font-bold text-[#111215] mb-6 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-[#7692FF]" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                            d="M17 16H8a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1h9m0 11h3a1 1 0 0 0 1-1V6a1 1 0 0 0-1-1h-3m0 11v-1m0-10v1" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                            d="M13 20H4a1 1 0 0 1-1-1v-9a1 1 0 0 1 1-1h3m6 11h3a1 1 0 0 0 1-1v-2.5M13 20v-1m4-9.999V9m0 3.001V12" />
                    </svg>
                    Agregar Entradas
                </h1>
                <x-ticket-form />
            </div>
        </div>
    </div>
</x-app-layout>