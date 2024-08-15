<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientesController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/blog', function () {
    return view('blog');
});

Route::get('/clientes',[ClientesController::class, 'index']);

Route::post('/postclientes',[ClientesController::class, 'store'])->name('clientes.post');

Route::put('/clientes/{id}',[ClientesController::class, 'update'])->name('clientes.update');

Route::delete('/clientes/{id}',[ClientesController::class, 'destroy'])->name('clientes.destroy');

Route::get('/contacto', function () {
    return view('contacto');
});


Route::get('/proyectos', function () {
    return view('proyectos');
});

Route::get('/servicios', function () {
    return view('servicios');
});

Route::get('/welcome', function () {
    return view('welcome');
});