<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SkillManageController;

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

// Portfolio
Route::get('/', [PortfolioController::class, 'index']);

Route::get('/portfolio/{id}', [PortfolioController::class, 'portfolioDetail']);

Route::get('/contact', function () {
    return view('contact');
});

Route::post('/contact_out', [ContactController::class, 'contact']);
Route::get('/contact_out', function () {
    return view('contact_out');
});

// admin
Route::group(['middleware' => ['auth']], function () {
    Route::get('/20031223', [AdminController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
    
    Route::get('/20031223/message', [ContactController::class, 'message']);
    
    // skill manage
    Route::get('/20031223/add_skill', function () {
        return view('add_skill');
    });
    Route::post('/add_skill', [SkillManageController::class, 'add_skill']);
    
    Route::post('/delete_skills', [SkillManageController::class, 'delete_skills']);
    
    Route::get('/20031223/edit_skill/{id}', [SkillManageController::class, 'skill_detail']);
    Route::post('/edit_skill/{id}', [SkillManageController::class, 'edit_skill']);
    
    Route::post('/delete_skill/{id}', [SkillManageController::class, 'delete_skill']);
    
    // portfolio manage
    Route::get('/20031223/add_portfolio', [PortfolioController::class, 'add_portfolio_page']);
    Route::post('/add_portfolio', [PortfolioController::class, 'add_portfolio']);
    
    Route::get('/20031223/edit_portfolio/{id}', [PortfolioController::class, 'edit_portfolio_page']);
    Route::post('/edit_portfolio/{id}', [PortfolioController::class, 'edit_portfolio']);
    
    Route::post('/delete_portfolio/{id}', [PortfolioController::class, 'delete_portfolio']);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
