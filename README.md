<p align="center"><img src="public/assets/icons/logosagafestmadrid.svg" width="400" alt="Logo Saga-Fest Madrid"></a></p>

# Saga-Fest Madrid - Proyecto TFG

Este proyecto es una aplicación web desarrollada en Laravel para dar publicidad a un festival de cultura pop, para la gestión de eventos, exposiciones, celebridades, expositores y para facilitar el acceso a través de la venta de entradas online a dicho festival.

## Características principales

- Crud completo de usuarios, celebridades, eventos, exposiciones, expositores, horarios, turnos, espacios y entradas.
- Gestión de eventos y exposiciones con horarios y turnos.
- Administración de celebridades y expositores.
- Sistema de compra y gestión de entradas mediante PayPal.
- Control de las vistas y funciones de los usuarios registrados y no registrados.
- Manejo de imágenes para eventos y celebridades.
- Sistema de autenticación y autorización.

## Requisitos

- PHP >= 8.1
- Composer
- Node.js y npm
- SQLite/MySQL/PostgreSQL

## Herramientas empleadas

Backend
- PHP (lenguaje principal)
- Laravel (framework principal)
- Composer (gestor de dependencias PHP)
- Eloquent ORM (ORM de Laravel)
- PHPUnit (testing en PHP)
- Carbon (fechas en PHP)
- Mail (sistema de correo de Laravel)

Frontend
- Blade (motor de plantillas de Laravel)
- Tailwind CSS (framework CSS utilitario)
- Vite (compilador/bundler de assets JS/CSS)
- PostCSS (procesador de CSS)
- JavaScript (para scripts en vistas)
- Alpine.js (posible, por el uso de x-data en vistas)

Base de datos
- SQLite (por el archivo database.sqlite)
- Migrations y Seeders de Laravel

Otros
- Leaflet (api de mapas)
- Node.js (para compilar assets)
- VS Code (por archivos de configuración y estructura)

## Instalación

Clona el repositorio:
   ```bash
   git clone https://github.com/tuusuario/tu-repo-tfg.git
   cd tu-repo-tfg
   ```
Instala dependencias PHP y JS:
   ```bash
   composer install
   npm install && npm run build
   ```
Copia el archivo de entorno y configura tus variables:
   ```bash
   cp .env.example .env
   # Edita .env con tus datos
   ```
Genera la clave de la aplicación:
   ```bash
   php artisan key:generate
   ```
Ejecuta migraciones y seeders:
   ```bash
   php artisan migrate --seed
   ```
Crea el enlace simbólico para las imágenes subidas:
   ```bash
   php artisan storage:link
   ```

## Uso

Inicia el servidor de desarrollo::
   ```bash
   npm run dev
   ```
   ```bash
   php artisan serve
   ```
