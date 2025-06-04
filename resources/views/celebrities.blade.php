<x-app-layout>
    <div class="max-w-2xl mx-auto py-12 px-4">
        <h1 class="text-3xl font-bold mb-6 text-white">{{ $celebrity->name }}</h1>
        <img src="{{ $celebrity->image_url }}" alt="{{ $celebrity->name }}" class="mb-6 rounded-lg w-full max-w-md">
        <div class="text-white mb-6">
            <p><strong>Biografía:</strong> {{ $celebrity->biography }}</p>
            <p><strong>Especialidad:</strong> {{ $celebrity->specialty }}</p>
            <!-- Agrega aquí más campos según tu modelo -->
        </div>
        <a href="{{ route('home') }}" class="text-blue-400 underline">← Volver al inicio</a>
    </div>
</x-app-layout>