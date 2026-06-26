<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\PrestamoController;
use App\Http\Controllers\SolicitanteController;

// Vista Raíz / Dashboard del Sistema
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Módulos principales del sistema (Controladores de Recursos automáticos)
Route::resource('solicitantes', SolicitanteController::class);
Route::resource('equipos', EquipoController::class);
Route::resource('prestamos', PrestamoController::class);

// Procesamiento de Devoluciones (Tu ruta POST establecida)
Route::post('/prestamos/{id}/devolver', [PrestamoController::class, 'devolver'])->name('prestamos.devolver');

// NUEVA RUTA: Descarga e impresión de comprobantes en formato PDF
Route::get('/prestamos/{id}/pdf', [PrestamoController::class, 'generarPdf'])->name('prestamos.pdf');
