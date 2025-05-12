<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\OfferController;

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//ruta mostrar form
Route::get('/form', [FormController::class, 'index'])->name('form.index');


//RUTAS BOOK CONTROLLER
Route::get('/addbook', [BookController::class, 'index'])->name('form.index');
Route::post('/savebook', [BookController::class, 'save'])->name('save.book');
Route::get('/book/{id}', [BookController::class, 'show'])->name('book.show');
Route::get('/bookedit/{id}', [BookController::class, 'edit'])->name('book.edit');
Route::put('/bookedit/{id}', [BookController::class, 'update'])->name('book.update');
Route::delete('/bookdelete/{id}', [BookController::class, 'destroy'])->name('book.delete');


//RUTAS TEACHER CONTROLLER
Route::get('/rutadd', [SubjectController::class, 'index'])->name('ruta.index');
Route::post('/save', [SubjectController::class, 'save'])->name('ruta.save');
Route::get('/show/{id}', [SubjectController::class, 'show'])->name('ruta.show');
Route::get('/edit/{id}', [SubjectController::class, 'edit'])->name('ruta.edit');
Route::put('/edit/{id}', [SubjectController::class, 'update'])->name('ruta.update');
Route::delete('/eliminar/{id}', [SubjectController::class, 'destroy'])->name('ruta.delete');

//RUTAS OFFER CONTROLLER
Route::get('/addoffer', [OfferController::class, 'index'])->name('offer.index');

Route::post('/saveoffer', [OfferController::class, 'save'])->name('offer.save');

Route::get('/offer/{id}', [OfferController::class, 'show'])->name('offer.show');

Route::get('/offeredit/{id}', [OfferController::class, 'edit'])->name('offer.edit');

Route::put('/offeredit/{id}', [OfferController::class, 'update'])->name('offer.update'); 

Route::post('/offerdelete/{id}', [OfferController::class, 'destroy'])->name('offer.delete');

Route::get('/offerlist', [OfferController::class, 'list'])->name('offer.list');

Route::get('/offers/filter', [OfferController::class, 'filter'])->name('offer.filter');


 





require __DIR__.'/auth.php';
