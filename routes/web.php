<?php

use Illuminate\Support\Facades\Route;


// middle ware
use App\Http\Middleware\CheckRoles;
use App\Http\Middleware\AccountisAdmin;
use App\Http\Middleware\isOfficer;
use App\Http\Middleware\isCollector;
use App\Http\Middleware\Logout;
use App\Http\Middleware\Authenticated;
use App\Http\Middleware\Unauthenticated;
use App\Http\Middleware\AccountisValid;
use App\Http\Middleware\Darkmode;

// authentication
use App\Livewire\Authentication\Logout as AuthenticationLogout;
use App\Livewire\Authentication\Login;

// admin
use App\Livewire\Admin\Dashboard\Dashboard;

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

Route::get('/logout', AuthenticationLogout::class)->middleware(Logout::class)->name('logout');

Route::middleware([Unauthenticated::class])->group(function () {
    Route::get('/login', Login::class)->name('login');
  
});


Route::get('/', function () {})->middleware(CheckRoles::class);

Route::middleware(isOfficer::class)->group(function () {
    Route::prefix('officer')->group(function () {
        
        
    });
});


Route::middleware(AccountisAdmin::class)->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', Dashboard::class)->name('admin-dashboard');
    });
});


Route::middleware(isCollector::class)->group(function () {
    Route::prefix('collector')->group(function () {
                
    });
});