<?php


use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;


// Página inicial
Route::get('/', function () {
    return Inertia::render('Welcome');
});


// Rotas protegidas
Route::middleware(['auth', 'verified'])->group(function () {
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/contacts/create', [DashboardController::class, 'create'])->name('contacts.create');
    Route::post('/contacts', [DashboardController::class, 'store'])->name('contacts.store');
    Route::get('/contacts/{contact}', [DashboardController::class, 'show'])->name('contacts.show');
    Route::get('/contacts/{contact}/edit', [DashboardController::class, 'edit'])->name('contacts.edit');
    Route::patch('/contacts/{contact}', [DashboardController::class, 'update'])->name('contacts.update');
    Route::delete('/contacts/{contact}', [DashboardController::class, 'destroy'])->name('contacts.destroy');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';