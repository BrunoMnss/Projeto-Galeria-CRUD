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



$frasecontroller = App\Http\Controllers\FraseGalleryController::class;

// Rota para exibição dos itens enviados
Route::get('/', [$frasecontroller, 'index'])->name('gallery.index');

// Rota para o envio dos itens(titulo, texto e imagem)
Route::post('/frase-gallery-upload', [$frasecontroller, 'upload'])->name('gallery.upload');

// Rota para exclusão do item(titulo, texto e imagem) selecionado pelo ID
Route::delete('/frase-gallery-delete/{id}', [$frasecontroller, 'destroy'])->name('gallery.delete');
