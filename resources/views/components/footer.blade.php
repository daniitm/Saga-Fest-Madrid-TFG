<div class="bg-[#1B2CC1] py-10 sm:py-12">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
            <!-- Logo y redes sociales -->
            <div class="flex flex-col items-center md:items-start">
                <div class="mb-6">
                    <a href="/">
                        <x-application-logo class="w-50 h-20 fill-current text-white" />
                    </a>
                </div>
                <div class="flex space-x-4 mb-2">
                    <a href="https://www.instagram.com" class="flex items-center justify-center w-12 h-12 rounded-full hover:opacity-75 transition-opacity" style="background-color: #091540;">
                        <img src="/assets/icons/instagram.svg" alt="Instagram" class="w-6 h-6">
                    </a>
                    <a href="https://www.facebook.com" target="_blank" rel="noopener noreferrer" class="flex items-center justify-center w-12 h-12 rounded-full hover:opacity-75 transition-opacity" style="background-color: #091540;">
                        <img src="/assets/icons/facebook.svg" alt="Facebook" class="w-6 h-6">
                    </a>
                    <a href="https://www.twitter.com" target="_blank" rel="noopener noreferrer" class="flex items-center justify-center w-12 h-12 rounded-full hover:opacity-75 transition-opacity" style="background-color: #091540;">
                        <img src="/assets/icons/twitter.svg" alt="Twitter" class="w-6 h-6">
                    </a>
                </div>
            </div>
            <!-- Secciones -->
            <div class="flex flex-col items-center md:items-start">
                <h2 class="text-white text-2xl font-extrabold mb-4">SECCIONES</h2>
                <ul class="space-y-2 text-white/90">
                    <li><a href="{{ route('home') }}" class="hover:underline">Saga-Fest Madrid</a></li>
                    <li><a href="{{ route('who-organises') }}" class="hover:underline">Quién Organiza</a></li>
                    <li><a href="{{ route('frequently-questions') }}" class="hover:underline">Preguntas Frecuentes</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:underline">Contacto</a></li>
                </ul>
            </div>
            <!-- Sobre nosotros -->
            <div class="flex flex-col items-center md:items-start">
                <h2 class="text-white text-2xl font-extrabold mb-4">SOBRE NOSOTROS</h2>
                <p class="text-white/90 text-center md:text-left">
                    Saga-Fest de Madrid es una corporación española sin ánimo de lucro dedicada a sensibilizar al público en general y a fomentar el aprecio por el comic y otras formas de arte popular relacionadas.
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Segundo footer -->
<footer style="background-color: #091540;" class="text-white py-6">
    <style>
        .footer-link {
            transition: color 0.3s;
        }
        .footer-link:hover,
        .footer-link:focus,
        .footer-link:active {
            color: #7692FF !important;
        }
    </style>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4 text-center md:text-left">
            <div class="flex flex-col sm:flex-row items-center gap-4 sm:gap-6">
                <a href="{{ route('privacy-policy') }}"
                    class="text-sm transition-colors duration-300 sm:border-r sm:border-white sm:pr-6 footer-link">
                    Política de privacidad
                </a>
                <a href="{{ route('terms-conditions') }}"
                    class="text-sm transition-colors duration-300 sm:border-r sm:border-white sm:pr-6 footer-link">
                    Términos y condiciones
                </a>
                <a href="{{ route('legal-advise') }}"
                    class="text-sm transition-colors duration-300 footer-link">
                    Aviso Legal
                </a>
            </div>
            <p class="text-sm">
                © 2025 Saga-Fest Madrid. Todos los derechos reservados.
            </p>
        </div>
    </div>
</footer>