<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\PayementController;

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

Route::get('/', [AuthController::class, 'loginRoute']);

Route::get('/index', [AppController::class, 'index'])->name('admin.index')->middleware('auth');
Route::get('/tab', function(){ return view('admin.dashboard');})->name('admin.dashboard')->middleware('auth');

// User

Route::get('/user/index/{retour?}', [UserController::class, 'index'])->name('user.index')->middleware('auth');
Route::get('/user/create/{retour?}', [UserController::class, 'create'])->name('user.create')->middleware('auth');
Route::post('/user/store', [UserController::class, 'store'])->name('user.store')->middleware('auth');
Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit')->middleware('auth');
Route::put('/user/update/{id}', [UserController::class, 'update'])->name('user.update')->middleware('auth');

//Facture

Route::get('/facture/index/{retour?}', [FactureController::class, 'index'])->name('facture.index')->middleware('auth');
Route::get('/facture/create/{retour?}', [FactureController::class, 'create'])->name('facture.create')->middleware('auth');
Route::post('/facture/store', [FactureController::class, 'store'])->name('facture.store')->middleware('auth');
Route::get('/facture/edit/{id}', [FactureController::class, 'edit'])->name('facture.edit')->middleware('auth');
Route::put('/facture/update/{id}', [FactureController::class, 'update'])->name('facture.update')->middleware('auth');
Route::get('/facture/etablir/{id}', [FactureController::class, 'etablir'])->name('facture.etablir')->middleware('auth');

//Article

Route::get('/prix_article/{sous}', [ArticleController::class, 'show'])->name('article.show')->middleware('auth');
Route::get('/article/{article}', [ArticleController::class, 'show_2'])->name('article.show_2')->middleware('auth');
Route::post('/article/', [ArticleController::class, 'store'])->name('article.store')->middleware('auth');
Route::put('/article/{article}', [ArticleController::class, 'update'])->name('article.update')->middleware('auth');
Route::delete('/article/{article}', [ArticleController::class, 'destroy'])->name('article.delete')->middleware('auth');

// Client

Route::post('/client/store', [ClientController::class, 'store'])->name('client.store')->middleware('auth');

// Item

Route::post('/items/store', [ItemController::class, 'store'])->name('item.store')->middleware('auth');
Route::get('/items/delete/{id}', [ItemController::class, 'destroy'])->name('item.delete')->middleware('auth');

//PDF

Route::get('/pdf/generate/{facture}', [PdfController::class, 'generate'])->name('facture.generate')->middleware('auth');

//Seting

Route::get('/settings/societe', [AppController::class, 'settingSocete'])->name('setting.societe')->middleware('auth');

// Payement

Route::post('/paiement/store', [PayementController::class, 'store'])->name('payement.store')->middleware('auth');
Route::get('/paiement/{facture}', [PayementController::class, 'dataPayement'])->name('paiement.facture')->middleware('auth');

