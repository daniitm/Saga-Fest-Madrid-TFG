@php
    $isCreate = request()->routeIs('admin.spaces.create');
    $areas = ['P0', 'C1', 'C2'];
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

<form method="POST" action="{{ $isCreate ? route('admin.spaces.store') : route('admin.spaces.destroy') }}">
    @csrf
    @if(!$isCreate)
        @method('DELETE')
    @endif
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-end">
        <!-- Selección de área -->
        <div class="relative">
            <label for="location_area" class="block text-sm font-medium text-gray-700 mb-1">Área *</label>
            <select name="location_area" id="location_area" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-primary focus:border-primary transition duration-150">
                <option value="" disabled {{ old('location_area') ? '' : 'selected' }}>Selecciona un área</option>
                @foreach($areas as $area)
                    <option value="{{ $area }}" {{ old('location_area') == $area ? 'selected' : '' }}>{{ $area }}</option>
                @endforeach
            </select>
            <div class="absolute left-0 w-full" style="min-height:1.5em;top:100%;">
                @if($errors->has('location_area'))
                    <p class="mt-1 text-xs text-red-500">{{ $errors->first('location_area') }}</p>
                @else
                    <p class="mt-1 text-xs invisible">&nbsp;</p>
                @endif
            </div>
        </div>
        <!-- Cantidad -->
        <div class="relative">
            <label for="quantity" class="block text-sm font-medium text-gray-700 mb-1">Cantidad *</label>
            <input name="quantity" id="quantity" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-primary focus:border-primary transition duration-150" value="{{ old('quantity') }}">
            <div class="absolute left-0 w-full" style="min-height:1.5em;top:100%;">
                @if($errors->has('quantity'))
                    <p class="mt-1 text-xs text-red-500">{{ $errors->first('quantity') }}</p>
                @else
                    <p class="mt-1 text-xs invisible">&nbsp;</p>
                @endif
            </div>
        </div>
        @if($isCreate)
        <!-- Tamaño solo en crear -->
        <div class="relative">
            <label for="space_size" class="block text-sm font-medium text-gray-700 mb-1">Tamaño *</label>
            <select name="space_size" id="space_size" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-primary focus:border-primary transition duration-150">
                <option value="" disabled {{ old('space_size') ? '' : 'selected' }}>Selecciona un tamaño</option>
                <option value="Grande" {{ old('space_size') == 'Grande' ? 'selected' : '' }}>Grande</option>
                <option value="Medio" {{ old('space_size') == 'Medio' ? 'selected' : '' }}>Medio</option>
                <option value="Pequeño" {{ old('space_size') == 'Pequeño' ? 'selected' : '' }}>Pequeño</option>
            </select>
            <div class="absolute left-0 w-full" style="min-height:1.5em;top:100%;">
                @if($errors->has('space_size'))
                    <p class="mt-1 text-xs text-red-500">{{ $errors->first('space_size') }}</p>
                @else
                    <p class="mt-1 text-xs invisible">&nbsp;</p>
                @endif
            </div>
        </div>
        @endif
    </div>
    <div class="flex items-center gap-4 mt-8">
        <button type="submit"
            class="inline-flex justify-center items-center px-6 py-2 bg-[#7692FF] hover:bg-[#1B2CC1] text-white font-semibold rounded transition duration-200">
            {{ $isCreate ? 'Agregar' : 'Eliminar' }}
        </button>
        <a href="{{ route('admin.spaces.index') }}"
            class="inline-flex justify-center items-center px-6 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold rounded transition duration-200">
            Cancelar
        </a>
    </div>
    @if(session('warning'))
        <div class="mt-4 p-4 bg-yellow-100 border border-yellow-400 text-yellow-700 rounded">
            {{ session('warning') }}
        </div>
    @endif
</form>
