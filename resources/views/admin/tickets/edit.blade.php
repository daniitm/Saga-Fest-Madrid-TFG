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
                    Editar Precio de Entradas
                </h1>

                <div class="mb-6">
                    <span class="block text-lg text-gray-800 font-semibold">
                        Tipo de entrada:
                        <span class="text-[#7692FF]">{{ $ticket->type }}</span>
                    </span>
                </div>

                <form method="POST" action="{{ route('admin.tickets.update', $ticket->id) }}">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="type" value="{{ $ticket->type }}">

                    <div class="mb-6">
                        <label for="price" class="block text-sm font-medium text-gray-700 mb-1">
                            Nuevo precio</span>
                        </label>
                        <input
                            name="price"
                            id="price"
                            min="0"
                            step="0.01"
                            value="{{ old('price', $ticket->price) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-primary focus:border-primary transition duration-150"
                        >
                        @error('price')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex gap-4">
                        <button type="submit"
                            class="inline-flex justify-center items-center px-6 py-2 bg-[#7692FF] hover:bg-[#1B2CC1] text-white font-semibold rounded transition duration-200">
                            Guardar cambios
                        </button>
                        <a href="{{ route('admin.tickets.index') }}"
                            class="inline-flex justify-center items-center px-6 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold rounded transition duration-200">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>