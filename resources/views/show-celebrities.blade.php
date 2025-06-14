<x-app-layout>
    <!-- Sección Celebridades (Sesión) -->
    <section class="bg-white py-14 sm:py-20 lg:py-22" style="background-color: #111215;">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
            <div class="text-center mb-12 sm:mb-16">
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold text-white mb-4">Todos las Celebridades invitadas</h2>
                <div class="w-20 h-1 bg-primary mx-auto"></div>
            </div>
            @if($celebrities->isEmpty())
                <div class="text-center py-16">
                    <p class="text-white text-lg font-semibold mb-4">No hay celebridades disponibles en este momento.</p>
                    <p class="text-white text-base">Si cree que esto se puede tratar de un error contacte con <a href="{{ route('contact') }}" class="text-primary underline">nosotros</a>.</p>
                </div>
            @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10 lg:gap-12">
                @foreach($celebrities as $celebrity)
                    <a href="{{ route('celebrity.show', $celebrity->id) }}" class="block transition-transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-primary rounded-2xl">
                        <div class="bg-gray-50 rounded-2xl p-8 sm:p-10 shadow-2xl" style="background-color: #363636;">
                            <div class="space-y-6">
                                <div class="w-full flex justify-center">
                                    <img src="{{ asset('storage/img/celebrities/' . ($celebrity->photo ?? 'imagen_perfil.png')) }}"
                                        alt="{{ $celebrity->name }} {{ $celebrity->surnames }}"
                                        class="rounded-lg w-full h-80 object-cover object-center mb-4" />
                                </div>
                                <div class="text-center">
                                    <h3 class="text-2xl font-semibold text-white mb-1">{{ $celebrity->name }} {{ $celebrity->surnames }}</h3>
                                    <span class="inline-block bg-primary text-white px-4 py-1 rounded-full text-sm font-semibold mb-2">
                                        {{ $celebrity->category }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            @endif
        </div>
    </section>
    <x-footer />
</x-app-layout>