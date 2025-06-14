@php
    $isCreate = request()->routeIs('admin.tickets.create');
    $ticketTypes = ['General', 'Premium'];
@endphp

@if(session('success'))
    <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
        {{ session('success') }}
    </div>
@endif
@if(session('warning'))
    <div class="mb-4 p-4 bg-yellow-100 border border-yellow-400 text-yellow-700 rounded">
        {{ session('warning') }}
    </div>
@endif

<form method="POST" action="{{ $isCreate ? route('admin.tickets.store') : route('admin.tickets.destroy') }}">
    @csrf
    @if(!$isCreate)
        @method('DELETE')
    @endif
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-end">
        <!-- Selección de tipo de ticket -->
        <div class="relative">
            <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Tipo de entrada *</label>
            <select name="type" id="type" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-primary focus:border-primary transition duration-150">
                <option value="" disabled {{ old('type') ? '' : 'selected' }}>Selecciona un tipo</option>
                @foreach($ticketTypes as $type)
                    <option value="{{ $type }}" {{ old('type') == $type ? 'selected' : '' }}>{{ $type }}</option>
                @endforeach
            </select>
            <div class="absolute left-0 w-full" style="min-height:1.5em;top:100%;">
                @if($errors->has('type'))
                    <p class="mt-1 text-xs text-red-500">{{ $errors->first('type') }}</p>
                @else
                    <p class="mt-1 text-xs invisible">&nbsp;</p>
                @endif
            </div>
        </div>
        <!-- Cantidad -->
        <div class="relative">
            <label for="quantity" class="block text-sm font-medium text-gray-700 mb-1">Cantidad *</label>
            <input name="quantity" id="quantity" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-primary focus:border-primary transition duration-150" value="{{ old('quantity') }}" autocomplete="off">
            <div class="absolute left-0 w-full" style="min-height:1.5em;top:100%;">
                @if($errors->has('quantity'))
                    <p class="mt-1 text-xs text-red-500">{{ $errors->first('quantity') }}</p>
                @else
                    <p class="mt-1 text-xs invisible">&nbsp;</p>
                @endif
            </div>
        </div>
        <!-- Botón para ambos tipos -->
        <div class="flex flex-col gap-2">
            <button type="button" id="toggleBothTypesBtn"
                class="inline-flex justify-center items-center px-6 py-2 bg-yellow-400 hover:bg-yellow-500 text-white font-semibold rounded transition duration-200"
                title="Aplicar a ambos tipos">
                + Aplicar a ambos tipos
            </button>
        </div>
    </div>
    <input type="hidden" name="apply_to_both" id="apply_to_both" value="0">
    <div class="flex items-center gap-4 mt-8">
        <button type="submit"
            class="inline-flex justify-center items-center px-6 py-2 bg-[#7692FF] hover:bg-[#1B2CC1] text-white font-semibold rounded transition duration-200">
            {{ $isCreate ? 'Agregar' : 'Eliminar' }}
        </button>
        <a href="{{ route('admin.tickets.index') }}"
            class="inline-flex justify-center items-center px-6 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold rounded transition duration-200">
            Cancelar
        </a>
    </div>
</form>
<script>
    document.getElementById('toggleBothTypesBtn')?.addEventListener('click', function () {
        const applyInput = document.getElementById('apply_to_both');
        if (applyInput.value === '0') {
            applyInput.value = '1';
            this.classList.add('bg-[#7692FF]');
            this.classList.remove('bg-yellow-400', 'hover:bg-yellow-500');
            this.textContent = '✓ Aplicando a ambos tipos';
        } else {
            applyInput.value = '0';
            this.classList.remove('bg-[#7692FF]');
            this.classList.add('bg-yellow-400', 'hover:bg-yellow-500');
            this.textContent = '+ Aplicar a ambos tipos';
        }
    });
</script>