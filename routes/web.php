<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\EdificioController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

# Rutas para Login
Route::get('/', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/', [AuthenticatedSessionController::class, 'store']);

# Ruta para Logout
Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

# Ruta para la vista En construcción
Route::get('/construccion', function () {
    return view('construccion');
})->name('construccion');

# Ruta para el Home
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'admin'])->name('dashboard');

# Ruta para el desplegable de departamento
Route::get('/dashboard', [DepartamentoController::class, 'listar'])->name('dashboard');

# Rutas para Dapartamento
Route::group([ 'prefix' => 'departamento',
               'middleware' => ['auth', 'admin'],
               'controller' => DepartamentoController::class,
               'as' => 'departamento.' ], 
                function() {
                    Route::match(['get', 'post'], '/mostrarEdificios', 'mostrar')->name('mostrar');
                    Route::match(['get', 'post'], '/validar', 'validar')->name('validar');
                    Route::get('/asociarEdificio/{departamento}', 'mostrarAsociarEdificio')->name('mostrarAsociarEdificio');
                    Route::post('/asociarEdificio/{departamento}', 'asociarEdificio')->name('asociarEdificio');
                    
                }
);

# Rutas para Edificio
Route::group([ 'prefix' => 'edificio',
                'middleware' => ['auth', 'admin'],
                'controller' => EdificioController::class,
                'as' => 'edificio.' ], 
                function() {
                    Route::get('/listar', 'listar')->name('listar');
                    Route::put('/actualizar/{edificio}', 'actualizar')->name('actualizar');
                    Route::delete('/borrar/{edificio}', 'borrar')->name('borrar');
                    Route::delete('/borrarTodo/{edificio}', 'borrarTodo')->name('borrarTodo');
                    Route::get('/mostrarEdificios/{departamento}', 'mostrarDatos')->name('mostrarDatos');
                    Route::match(['get', 'post'], 'crearEdificio', 'crear')->name('crear');
                    Route::match(['get', 'post'], 'editar/{edificio}', 'editar')->name('editar');

                }
);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
