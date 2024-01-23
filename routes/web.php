<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\UsuarioController;

// Rutas para las operaciones CRUD
Route::get('usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');
Route::get('usuarios/create', [UsuarioController::class, 'create'])->name('usuarios.create');
Route::post('usuarios', [UsuarioController::class, 'store'])->name('usuarios.store');
Route::get('usuarios/{id}', [UsuarioController::class, 'show'])->name('usuarios.show');
Route::get('usuarios/{id}/edit', [UsuarioController::class, 'edit'])->name('usuarios.edit');
Route::put('usuarios/{id}', [UsuarioController::class, 'update'])->name('usuarios.update');
Route::delete('usuarios/{id}', [UsuarioController::class, 'destroy'])->name('usuarios.destroy');

// Rutas para los endpoints adicionales
Route::get('usuarios/buscar/{nombre}', [UsuarioController::class, 'buscarPorNombre'])->name('usuarios.buscar');
Route::get('usuarios/filtrar/{fechaInicio}/{fechaFin}', [UsuarioController::class, 'filtrarPorFecha'])->name('usuarios.filtrar');
