<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductoApiController;
use App\Http\Controllers\ClienteApiController;
use App\Http\Controllers\UsuarioApiController;
use App\Http\Controllers\DashboardApiController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('jwt')->post('/logout', [AuthController::class, 'logout']);

Route::middleware('jwt')->get('/perfil', function (Request $request) {
    return response()->json([
        'message' => 'Acceso autorizado',
        'usuario' => auth('api')->user(),
    ]);
});

Route::middleware('jwt')->group(function () {
    Route::apiResource('productos', ProductoApiController::class)->names('api.productos');
    Route::apiResource('clientes', ClienteApiController::class)->names('api.clientes');

    Route::get('/usuarios', [UsuarioApiController::class, 'index'])->name('api.usuarios.index');
    Route::get('/usuarios/{id}', [UsuarioApiController::class, 'show'])->name('api.usuarios.show');
    Route::put('/usuarios/{id}', [UsuarioApiController::class, 'update'])->name('api.usuarios.update');
    Route::delete('/usuarios/{id}', [UsuarioApiController::class, 'destroy'])->name('api.usuarios.destroy');

    Route::get('/dashboard', [DashboardApiController::class, 'index'])->name('api.dashboard');
});
