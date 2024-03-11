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
use App\Livewire\Admin\AuditLogs\AuditLogs;
use App\Livewire\Admin\Colleges\Colleges;
use App\Livewire\Admin\Dashboard\Dashboard;
use App\Livewire\Admin\EnrolledStudents\EnrolledStudents;
use App\Livewire\Admin\PaymentRecords\PaymentRecords;
use App\Livewire\Admin\Payments\Payments;
use App\Livewire\Admin\RemitRecords\RemitRecords;
use App\Livewire\Admin\Settings\Fees\Fees;
use App\Livewire\Admin\Settings\Overview\Overview;
use App\Livewire\Admin\Settings\UserManagement\UserManagement;
use App\Livewire\Admin\Students\Students;
use App\Livewire\Admin\SystemLogs\SystemLogs;


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
        Route::get('/payments', Payments::class)->name('admin-payments');
        Route::get('/paymentrecords', PaymentRecords::class)->name('admin-paymentrecords');
        Route::get('/remitrecords', RemitRecords::class)->name('admin-remitrecords');
        Route::get('/enrolledstudents', EnrolledStudents::class)->name('admin-enrolledstudents');
        Route::get('/students', Students::class)->name('admin-students');
        Route::get('/colleges', Colleges::class)->name('admin-colleges');
        Route::get('/systemlogs', SystemLogs::class)->name('admin-systemlogs');
        Route::get('/auditlogs', AuditLogs::class)->name('admin-auditlogs');
        Route::get('/overview', Overview::class)->name('admin-overview');
        Route::get('/fees', Fees::class)->name('admin-fees');
        Route::get('/usermanagement', UserManagement::class)->name('admin-usermanagement');
    });
});


Route::middleware(isCollector::class)->group(function () {
    Route::prefix('collector')->group(function () {
                
    });
});