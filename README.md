<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Proyecto TFG - Gestión de Eventos y Exposiciones

Este proyecto es una aplicación web desarrollada en Laravel para la gestión de eventos, exposiciones, celebridades, expositores y venta de entradas.

## Características principales

- Gestión de eventos y exposiciones con turnos y horarios.
- Administración de celebridades y expositores.
- Sistema de compra y gestión de entradas.
- Panel de administración para usuarios y roles.
- Subida y gestión de imágenes para eventos y celebridades.
- Sistema de autenticación y autorización.

## Requisitos

- PHP >= 8.1
- Composer
- Node.js y npm
- SQLite/MySQL/PostgreSQL

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
