<?php

use Illuminate\Support\Facades\Route;


// middle ware
use App\Http\Middleware\CheckRoles;
use App\Http\Middleware\isAdmin;
use App\Http\Middleware\isUsc;
use App\Http\Middleware\isCsc;
use App\Http\Middleware\isCollector;
use App\Http\Middleware\Logout;
use App\Http\Middleware\Authenticated;
use App\Http\Middleware\Unauthenticated;
use App\Http\Middleware\AccountisValid;
use App\Http\Middleware\Darkmode;
use App\Http\Middleware\checkTerm;

// authentication
use App\Livewire\Authentication\Logout as AuthenticationLogout;
use App\Livewire\Authentication\Login;
use App\Livewire\Authentication\DisabledAccount;
use App\Livewire\Authentication\TermEnded;

// admin
use App\Livewire\Admin\AuditLogs\AuditLogs as AdminAuditLogs;
use App\Livewire\Admin\Colleges\Colleges as AdminColleges;
use App\Livewire\Admin\Dashboard\Dashboard as AdminDashboard;
use App\Livewire\Admin\EnrolledStudents\EnrolledStudents as AdminEnrolledStudents;
use App\Livewire\Admin\PaymentRecords\PaymentRecords as AdminPaymentRecords;
use App\Livewire\Admin\Payments\Payments as AdminPayments;
use App\Livewire\Admin\RemitRecords\RemitRecords as AdminRemitRecords;
use App\Livewire\Admin\Settings\Fees\Fees as AdminFees;
use App\Livewire\Admin\Settings\Overview\Overview as AdminOverview;
use App\Livewire\Admin\Settings\UserManagement\UserManagement as AdminUserManagement;
use App\Livewire\Admin\Settings\Profile\Profile as AdminProfile;
use App\Livewire\Admin\Students\Students as AdminStudents;
use App\Livewire\Admin\SystemLogs\SystemLogs as AdminSystemLogs;
use App\Livewire\Admin\Departments\Departments as AdminDepartments;


use App\Livewire\Usc\Dashboard\Dashboard as UscDashboard;
use App\Livewire\Usc\Fees\Fees as UscFees;
use App\Livewire\Usc\Paymentrecords\Paymentrecords as UscPaymentrecords;
use App\Livewire\Usc\Remitrecords\Remitrecords as UscRemitrecords;
use App\Livewire\Usc\Remittance\Remittance as UscRemittance;
use App\Livewire\Usc\Profile\Profile as UscProfile;

use App\Livewire\Csc\Auditlogs\Auditlogs as CscAuditlogs;
use App\Livewire\Csc\Dashboard\Dashboard as CscDashboard;
use App\Livewire\Csc\Enrolledstudents\Enrolledstudents as CscEnrolledstudents;
use App\Livewire\Csc\Students\Students as CscStudents;
use App\Livewire\Csc\Fees\Fees as CscFees;
use App\Livewire\Csc\Paymentrecords\Paymentrecords as CscPaymentrecords;
use App\Livewire\Csc\Payments\Payments as CscPayments;
use App\Livewire\Csc\Remitrecords\Remitrecords as CscRemitrecords;
use App\Livewire\Csc\Remittance\Remittance as CscRemittance;
use App\Livewire\Csc\Payments\StudentPayments as CscStudentPayments;
use App\Livewire\Csc\Profile\Profile as CscProfile;

use App\Livewire\Csc\Dashboard\Dashboard;
use App\Livewire\Csc\Payments\Payments;
use App\Livewire\Csc\Paymentrecords\Paymentrecords;
use App\Livewire\Csc\Auditlogs\Auditlogs;
use App\Livewire\Csc\Profile\Profile;



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
Route::get('/term-ended', TermEnded::class)->name('term-ended');


Route::get('/', function () {})->middleware(CheckRoles::class);



Route::middleware([AccountisValid::class,isAdmin::class])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', AdminDashboard::class)->name('admin-dashboard');
        Route::get('/paymentrecords', AdminPaymentRecords::class)->name('admin-paymentrecords');
        Route::get('/remitrecords', AdminRemitRecords::class)->name('admin-remitrecords');
        Route::get('/enrolledstudents', AdminEnrolledStudents::class)->name('admin-enrolledstudents');
        Route::get('/students', AdminStudents::class)->name('admin-students');
        Route::get('/colleges', AdminColleges::class)->name('admin-colleges');
        Route::get('/departments/{college_id}', AdminDepartments::class)->name('admin-departments');
        
        Route::get('/auditlogs', AdminAuditLogs::class)->name('admin-auditlogs');
        Route::get('/systemlogs', AdminSystemLogs::class)->name('admin-systemlogs');
       
        Route::get('/fees', AdminFees::class)->name('admin-fees');
        Route::get('/overview', AdminOverview::class)->name('admin-overview');
        Route::get('/usermanagement', AdminUserManagement::class)->name('admin-usermanagement');
        Route::get('/profile', AdminProfile::class)->name('admin-profile');

    });
});

Route::middleware([AccountisValid::class,isUsc::class,checkTerm::class])->group(function () {
    Route::prefix('usc')->group(function () {
        Route::get('/dashboard', UscDashboard::class)->name('usc-dashboard');
        Route::get('/paymentrecords', UscPaymentRecords::class)->name('usc-paymentrecords');
        Route::get('/remittance', UscRemittance::class)->name('usc-remittance');
        Route::get('/remitrecords', UscRemitRecords::class)->name('usc-remitrecords');
       
        Route::get('/fees', UscFees::class)->name('usc-fees');
        Route::get('/profile', UscProfile::class)->name('usc-profile');

    });
});

Route::middleware([AccountisValid::class,isCsc::class,isCollector::class,checkTerm::class])->group(function () {
    Route::prefix('csc')->group(function () {
        Route::get('/dashboard', CscDashboard::class)->name('csc-dashboard');
        Route::get('/payments', CscPayments::class)->name('csc-payments');
        Route::get('/payments/{student_id}', CscStudentPayments::class)->name('csc-student-payments');
        Route::get('/payments/{student_id}/{semester}', CscStudentPayments::class)->name('csc-student-payments-semester');
        Route::get('/paymentrecords', CscPaymentRecords::class)->name('csc-paymentrecords');
        Route::get('/remittance', CscRemittance::class)->name('csc-remittance');
        Route::get('/remitrecords', CscRemitRecords::class)->name('csc-remitrecords');
        Route::get('/enrolledstudents', CscEnrolledStudents::class)->name('csc-enrolledstudents');
        Route::get('/students', CscStudents::class)->name('csc-students');
        Route::get('/auditlogs', CscAuditLogs::class)->name('csc-auditlogs');
      
        Route::get('/fees', CscFees::class)->name('csc-fees');
        Route::get('/profile', CscProfile::class)->name('csc-profile');

    });
});

Route::middleware([AccountisValid::class,isCsc::class,checkTerm::class])->group(function () {
    Route::prefix('csc/collector')->group(function () {
        Route::get('/dashboard', Dashboard::class)->name('csc-collector-dashboard');
        Route::get('/payments', Payments::class)->name('csc-collector-payments');
        Route::get('/payments/{student_id}', CscStudentPayments::class)->name('csc-collector-student-payments');
        Route::get('/payments/{student_id}/{semester}', CscStudentPayments::class)->name('csc-collector-student-payments-semester');
        Route::get('/paymentrecords', PaymentRecords::class)->name('csc-collector-paymentrecords');
        Route::get('/auditlogs', AuditLogs::class)->name('csc-collector-auditlogs');
        Route::get('/profile]', Profile::class)->name('csc-collector-profile');

    });
});