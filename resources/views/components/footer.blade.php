<div class="bg-[#1B2CC1] py-10 sm:py-12">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            <!-- Columna 1: Logo grande y redes sociales (1/3) -->
            <div class="flex flex-col items-start gap-6 md:col-span-1 w-full md:pr-0 md:pl-0">
                <a href="https://www.ugr.es/" target="_blank" rel="noopener noreferrer" class="flex justify-start w-full">
                    <img src="/assets/icons/logo-ugr.svg" alt="Saga-Fest Madrid" class="h-40 w-auto mb-6">
                </a>
                <div class="flex flex-row gap-6 justify-start w-full">
                    <a href="https://www.facebook.com" target="_blank" rel="noopener noreferrer" class="hover:opacity-75 transition-opacity flex items-center justify-center">
                        <img src="/assets/icons/facebook.svg" alt="Facebook" class="w-7 h-7 object-contain">
                    </a>
                    <a href="https://www.instagram.com" target="_blank" rel="noopener noreferrer" class="hover:opacity-75 transition-opacity flex items-center justify-center">
                        <img src="/assets/icons/instagram.svg" alt="Instagram" class="w-7 h-7 object-contain">
                    </a>
                    <a href="https://www.twitter.com" target="_blank" rel="noopener noreferrer" class="hover:opacity-75 transition-opacity flex items-center justify-center">
                        <img src="/assets/icons/twitter.svg" alt="Twitter" class="w-7 h-7 object-contain">
                    </a>
                </div>
            </div>
            <!-- Columna 2: Secciones (2/3) -->
            <div class="md:col-span-2 flex flex-col items-center md:items-start gap-4 w-full">
                <h2 class="text-3xl font-bold text-white mb-2">Secciones</h2>
                <div class="grid grid-cols-2 gap-x-8 gap-y-2 w-full">
                    <div class="flex flex-col text-lg gap-2">
                        <a href="{{ route('home') }}" class="flex items-center text-white hover:underline">
                            <span class="inline-block w-1.5 h-1.5 rounded-full bg-white mt-2 mr-2"></span>
                            Saga-Fest Madrid
                        </a>
                        <a href="#" class="flex items-center text-white hover:underline">
                            <span class="inline-block w-1.5 h-1.5 rounded-full bg-white mt-2 mr-2"></span>
                            Quién Organiza
                        </a>
                        <a href="#" class="flex items-center text-white hover:underline">
                            <span class="inline-block w-1.5 h-1.5 rounded-full bg-white mt-2 mr-2"></span>
                            Programación
                        </a>
                    </div>
                    <div class="flex flex-col text-lg gap-2">
                        <a href="#" class="flex items-center text-white hover:underline">
                            <span class="inline-block w-1.5 h-1.5 rounded-full bg-white mt-2 mr-2"></span>
                            Preguntas Frecuentes
                        </a>
                        <a href="#" class="flex items-center text-white hover:underline">
                            <span class="inline-block w-1.5 h-1.5 rounded-full bg-white mt-2 mr-2"></span>
                            Contacto
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer legal - Más compacto y funcional -->
<footer style="background-color: #091540;" class="text-white py-6">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4 text-center md:text-left">
            <div class="flex flex-col sm:flex-row items-center gap-4 sm:gap-6">
                <a href="{{ route('privacy-policy') }}" class="text-sm hover:text-white/80 transition-colors duration-300 sm:border-r sm:border-white sm:pr-6">Política de privacidad</a>
                <a href="{{ route('terms-conditions') }}" class="text-sm hover:text-white/80 transition-colors duration-300 sm:border-r sm:border-white sm:pr-6">Términos y condiciones</a>
                <a href="{{ route('legal-advise') }}" class="text-sm hover:text-white/80 transition-colors duration-300">Aviso Legal</a>
            </div>
            <p class="text-sm">© 2025 Saga-Fest Madrid. Todos los derechos reservados.</p>
        </div>
    </div>
</footer>