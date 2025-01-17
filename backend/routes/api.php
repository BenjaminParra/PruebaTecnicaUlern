<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuariosController;

Route::post('/login', [UsuariosController::class, 'login']);

Route::get('/usuarios', [UsuariosController::class, 'index']);

Route::get('/usuarios/{id}', [UsuariosController::class, 'show']);

Route::post('/usuarios', [UsuariosController::class, 'store']);
