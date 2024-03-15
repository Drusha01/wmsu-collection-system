<?php

use Illuminate\Support\Facades\Route;


// middle ware
use App\Http\Middleware\CheckRoles;
use App\Http\Middleware\isAdmin;
use App\Http\Middleware\isUsc;
use App\Http\Middleware\isCollector;
use App\Http\Middleware\Logout;
use App\Http\Middleware\Authenticated;
use App\Http\Middleware\Unauthenticated;
use App\Http\Middleware\AccountisValid;
use App\Http\Middleware\Darkmode;

// authentication
use App\Livewire\Authentication\Logout as AuthenticationLogout;
use App\Livewire\Authentication\Login;
use App\Livewire\Authentication\DisabledAccount;
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

Route::get('/disabled', DisabledAccount::class)->name('disabled-account');

Route::get('/', function () {})->middleware(CheckRoles::class);



Route::middleware([AccountisValid::class,isAdmin::class])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', Dashboard::class)->name('admin-dashboard');
        Route::get('/paymentrecords', PaymentRecords::class)->name('admin-paymentrecords');
        Route::get('/remitrecords', RemitRecords::class)->name('admin-remitrecords');
        Route::get('/enrolledstudents', EnrolledStudents::class)->name('admin-enrolledstudents');
        Route::get('/students', Students::class)->name('admin-students');
        Route::get('/colleges', Colleges::class)->name('admin-colleges');
        Route::get('/auditlogs', AuditLogs::class)->name('admin-auditlogs');
        Route::get('/systemlogs', SystemLogs::class)->name('admin-systemlogs');
       
        Route::get('/overview', Overview::class)->name('admin-overview');
        Route::get('/usermanagement', UserManagement::class)->name('admin-usermanagement');
    });
});

Route::middleware([AccountisValid::class,isUsc::class])->group(function () {
    Route::prefix('usc')->group(function () {
        Route::get('/dashboard', Dashboard::class)->name('usc-dashboard');
        Route::get('/paymentrecords', PaymentRecords::class)->name('usc-paymentrecords');
        Route::get('/remittance', RemitRecords::class)->name('usc-remittance');
        Route::get('/remitrecords', RemitRecords::class)->name('usc-remitrecords');
       
        Route::get('/fees', Fees::class)->name('usc-fees');
    });
});

Route::middleware([AccountisValid::class,isCsc::class,isCollector::class])->group(function () {
    Route::prefix('csc')->group(function () {
        Route::get('/dashboard', Dashboard::class)->name('csc-dashboard');
        Route::get('/payments', Payments::class)->name('csc-payments');
        Route::get('/paymentrecords', PaymentRecords::class)->name('csc-paymentrecords');
        Route::get('/remittance', RemitRecords::class)->name('csc-remittance');
        Route::get('/remitrecords', RemitRecords::class)->name('csc-remitrecords');
        Route::get('/enrolledstudents', EnrolledStudents::class)->name('csc-enrolledstudents');
        Route::get('/auditlogs', AuditLogs::class)->name('csc-auditlogs');
      
        Route::get('/fees', Fees::class)->name('csc-fees');

    });
});

Route::middleware([AccountisValid::class,isCsc::class,isCollector::class])->group(function () {
    Route::prefix('csc/collector')->group(function () {
        Route::get('/dashboard', Dashboard::class)->name('csc-collector-dashboard');
        Route::get('/payments', Payments::class)->name('csc-collector-payments');
        Route::get('/paymentrecords', PaymentRecords::class)->name('csc-collector-paymentrecords');
        Route::get('/auditlogs', AuditLogs::class)->name('csc-collector-auditlogs');
    });
});