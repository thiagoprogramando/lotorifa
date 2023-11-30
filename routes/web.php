<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GameController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Cliente\CartController;
use App\Http\Controllers\Cliente\IndexController;
use App\Http\Controllers\Cliente\UserController as ClienteUserController;
use Illuminate\Support\Facades\Route;

//ADMIN - Não Autenticado
Route::get('/admin', function () { return view('dashboard.login'); })->name('admin');
Route::post('/loginAdmin', [UserController::class, 'login'])->name('loginAdmin');

//CLIENTE - Não Autenticado
Route::get('/', [IndexController::class, 'index'])->name('inicio');

Route::get('/cadastro/{id?}', [IndexController::class, 'registre'])->name('cadastro');
Route::post('createUser', [ClienteUserController::class, 'createUser'])->name('createUser');

Route::get('/acesso', [IndexController::class, 'login'])->name('acesso');
Route::post('loginCliente', [ClienteUserController::class, 'login'])->name('loginCliente');

Route::get('/resultado', [IndexController::class, 'result'])->name('resultado');
Route::get('/numeros/{id}', [IndexController::class, 'number_option'])->name('numeros');
Route::get('/ranking', [IndexController::class, 'ranking'])->name('ranking');
Route::get('/afiliado', [IndexController::class, 'affiliate'])->name('afiliado');
Route::get('/cadastraCliente/{id?}', function ($id = null) { return view('register')->with('id', $id); });

Route::middleware(['auth'])->group(function () {

    //ADMIN - Autenticado
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    Route::get('/jogos', [GameController::class, 'game'])->name('jogos');
    Route::get('/viewGame/{id}', [GameController::class, 'viewGame'])->name('viewGame');
    Route::post('/createGame', [GameController::class, 'createGame'])->name('createGame');
    Route::post('/deleteGame', [GameController::class, 'deleteGame'])->name('deleteGame');

    Route::post('/blocksBet', [GameController::class, 'blocksBet'])->name('blocksBet');

    Route::get('/premiados', [GameController::class, 'awarded'])->name('premiados');
    
    //AMBOS - Autenticado
    Route::get('/sair', [UserController::class, 'logout'])->name('sair');
    Route::get('/sairCliente', [UserController::class, 'logoutClient'])->name('sairCliente');
    
    //Cliente - Autenticado
    Route::get('carteira', [ClienteUserController::class, 'wallet'])->name('carteira');

    Route::post('endcart', [CartController::class, 'endcart'])->name('endcart');
});
