<?php

//use App\Http\Controllers\HomeController;
use App\Http\Controllers\AddresseController;
use App\Http\Controllers\AfhentningstypeController;
use App\Http\Controllers\ArtisanController;
use App\Http\Controllers\FabrikantController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KundeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MedarbejderController;
use App\Http\Controllers\ModelController;
use App\Http\Controllers\ProduktController;
use App\Http\Controllers\ProdukttypeController;
use App\Http\Controllers\SagController;
use App\Http\Controllers\SagtypeController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\TargetController;
use App\Http\Controllers\TokenController;
use Illuminate\Support\Facades\Auth;
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
})->name('welcome');

Route::get('/login', [LoginController::class, 'form'])->name('login.form');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/Artisan/cache', [ArtisanController::class, 'cacheAll'])->name('artisan.cache.base');
Route::get('/Artisan/cache/all', [ArtisanController::class, 'cacheAll'])->name('artisan.cache.all');
Route::get('/Artisan/cache/route', [ArtisanController::class, 'cacheRoute'])->name('artisan.cache.route');
Route::get('/Artisan/cache/config', [ArtisanController::class, 'cacheConfig'])->name('artisan.cache.config');
Route::get('/Artisan/cache/view', [ArtisanController::class, 'cacheView'])->name('artisan.cache.view');
Route::get('/Artisan/cache/clear', [ArtisanController::class, 'cacheClear'])->name('artisan.cache.clear');

Route::middleware(['loggedin'])->group(function () {
    Route::get('/home', [HomeController::class, 'home'])->name('home');

    Route::get('/sager/mine', [SagController::class, 'mine'])->name('sager.mine');
    Route::put('/medarbejdere/password', [MedarbejderController::class, 'password'])->name('Medarbejder.password');
    Route::put('/medarbejdere/navn', [MedarbejderController::class, 'navn'])->name('Medarbejder.navn');

    Route::put('/kunder/password', [KundeController::class, 'password'])->name('Kunde.password');
    Route::put('/kunder/navn', [KundeController::class, 'navn'])->name('Kunde.navn');
    Route::get('/kunder/sager', [KundeController::class, 'sager'])->name('Kunde.sager');

    Route::put('/addresser/{id}/foretrukken', [AddresseController::class, 'foretrukken'])->name('addresser.foretrukken.add');
    Route::delete('/addresser/{id}/foretrukken', [AddresseController::class, 'foretrukkenFjern'])->name('addresser.foretrukken.remove');


    Route::resource('produkter', '\App\Http\Controllers\ProduktController')->only(['index', 'store', 'update', 'destroy']);
    Route::resource('produkttyper', '\App\Http\Controllers\ProdukttypeController')->only(['index', 'store', 'update', 'destroy']);
    Route::resource('fabrikanter', '\App\Http\Controllers\FabrikantController')->only(['index', 'store', 'update', 'destroy']);
    Route::resource('modeller', '\App\Http\Controllers\ModelController')->only(['index', 'store', 'update', 'destroy']);
    Route::resource('tokens', '\App\Http\Controllers\TokenController')->only(['index', 'store', 'update', 'destroy']);
    Route::resource('targets', '\App\Http\Controllers\TargetController')->only(['index', 'store', 'update', 'destroy']);
    Route::resource('sager', '\App\Http\Controllers\SagController');
    Route::resource('sagstyper', '\App\Http\Controllers\SagtypeController')->only(['index', 'store', 'update', 'destroy']);
    Route::resource('statuser', '\App\Http\Controllers\StatusController')->only(['index', 'store', 'update', 'destroy']);
    Route::resource('afhentningstyper', '\App\Http\Controllers\AfhentningstypeController')->only(['index', 'store', 'update', 'destroy']);
    Route::resource('medarbejdere', '\App\Http\Controllers\MedarbejderController')->only(['index', 'store', 'update', 'destroy']);
    Route::resource('kunder', '\App\Http\Controllers\KundeController')->only(['index', 'store', 'update', 'destroy']);
    Route::resource('addresser', '\App\Http\Controllers\AddresseController')->only(['index', 'store', 'update', 'destroy']);
});

//Auth::routes();

//Route::get('/home', [HomeController::class, 'index'])->name('home');
