<?php

use App\Http\Controllers\BudgetController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(['auth'])->group(function () {
    Route::get('/budgets', [BudgetController::class, 'index'])->name('budgets.index'); // Display budgets
    Route::get('/budgets/create', [BudgetController::class, 'create'])->name('budgets.create'); // Form to add a new budget
    Route::post('/budgets', [BudgetController::class, 'store'])->name('budgets.store'); // Store a new budget
    Route::get('/budgets/{budget}/edit', [BudgetController::class, 'edit'])->name('budgets.edit'); // Form to edit an existing budget
    Route::put('/budgets/{budget}', [BudgetController::class, 'update'])->name('budgets.update'); // Update an existing budget
    Route::delete('/budgets/{budget}', [BudgetController::class, 'destroy'])->name('budgets.destroy'); // Delete an existing budget
});

// Route::get('/dashboard', [BudgetController::class, 'index'])
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
