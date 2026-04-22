<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\LabourController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\MaterialTransactionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\InvestorDashboardController;
use App\Http\Controllers\WebsiteContentController;
use App\Http\Controllers\InvestorController;
use App\Http\Controllers\InvestmentController;
use App\Http\Controllers\PayoutController;
use App\Http\Controllers\ProjectUpdateController;
use Illuminate\Support\Facades\Route;

// Public Website Routes (Blade-based)
Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/about', [PublicController::class, 'about'])->name('about');
Route::get('/services', [PublicController::class, 'services'])->name('services');
Route::get('/projects-portfolio', [PublicController::class, 'projects'])->name('projects');
Route::get('/invest', [PublicController::class, 'invest'])->name('public.invest');
Route::get('/contact', [PublicController::class, 'contact'])->name('contact');
Route::get('/privacy-policy', [PublicController::class, 'privacy'])->name('privacy');
Route::get('/terms-and-conditions', [PublicController::class, 'terms'])->name('terms');
Route::get('/faq', [PublicController::class, 'faq'])->name('faq');

// Auth Routes (handled by Laravel)
require __DIR__.'/auth.php';

// Admin Panel Routes (Blade-based)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Projects
    Route::resource('projects', ProjectController::class);
    
    // Expenses
    Route::resource('expenses', ExpenseController::class);
    
    // Labour & Attendance
    Route::resource('labour', LabourController::class);
    Route::get('/attendance/create', [AttendanceController::class, 'create'])->name('attendance.create');
    Route::post('/attendance', [AttendanceController::class, 'store'])->name('attendance.store');
    
    // Materials & Transactions
    Route::resource('materials', MaterialController::class);
    Route::resource('material_transactions', MaterialTransactionController::class);
    
    // Vendors
    Route::resource('vendors', VendorController::class);
    
    // Reports & Analytics
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    
    // Website Content Management (CMS)
    Route::get('/website-content', [WebsiteContentController::class, 'index'])->name('website-content.index');
    Route::patch('/website-content/update-all', [WebsiteContentController::class, 'update'])->name('website-content.update-all');

    // Pricing Plans Management
    Route::resource('construction-plans', \App\Http\Controllers\ConstructionPlanController::class);

    // Email Configuration
    Route::get('/email-config', [\App\Http\Controllers\EmailConfigurationController::class, 'index'])->name('admin.email-config.index');
    Route::patch('/email-config', [\App\Http\Controllers\EmailConfigurationController::class, 'update'])->name('admin.email-config.update');

    // Group Email
    Route::get('/group-email', [\App\Http\Controllers\GroupEmailController::class, 'index'])->name('admin.group-email.index');
    Route::post('/group-email', [\App\Http\Controllers\GroupEmailController::class, 'send'])->name('admin.group-email.send');

    // Investor Management
    Route::resource('investors', InvestorController::class);
    Route::patch('investments/{investment}/approve', [InvestmentController::class, 'approve'])->name('investments.approve');
    Route::resource('investments', InvestmentController::class);
    Route::patch('payouts/{payout}/approve', [PayoutController::class, 'approve'])->name('payouts.approve');
    Route::resource('payouts', PayoutController::class);

    // Investor Dashboard Routes
    Route::prefix('investor')->name('investor.')->group(function () {
        Route::get('/dashboard', [InvestorDashboardController::class, 'index'])->name('dashboard');
        
        Route::prefix('portfolio')->name('portfolio.')->group(function () {
            Route::get('/overview', [InvestorDashboardController::class, 'index'])->name('overview');
            Route::get('/active', [InvestorDashboardController::class, 'index'])->name('active');
            Route::get('/completed', [InvestorDashboardController::class, 'index'])->name('completed');
        });

        Route::prefix('projects')->name('projects.')->group(function () {
            Route::get('/all', [InvestorDashboardController::class, 'index'])->name('all');
            Route::get('/performance', [InvestorDashboardController::class, 'index'])->name('performance');
            Route::get('/{id}', [InvestorDashboardController::class, 'projectDetails'])->name('details');
        });

        Route::prefix('earnings')->name('earnings.')->group(function () {
            Route::get('/summary', [InvestorDashboardController::class, 'index'])->name('summary');
            Route::get('/history', [InvestorDashboardController::class, 'index'])->name('history');
            Route::get('/analytics', [InvestorDashboardController::class, 'index'])->name('analytics');
        });

        Route::prefix('transactions')->name('transactions.')->group(function () {
            Route::get('/all', [InvestorDashboardController::class, 'index'])->name('all');
            Route::get('/history', [InvestorDashboardController::class, 'index'])->name('history');
            Route::get('/withdrawals', [InvestorDashboardController::class, 'index'])->name('withdrawals');
        });

        Route::prefix('documents')->name('documents.')->group(function () {
            Route::get('/agreements', [InvestorDashboardController::class, 'index'])->name('agreements');
            Route::get('/reports', [InvestorDashboardController::class, 'index'])->name('reports');
            Route::get('/receipts', [InvestorDashboardController::class, 'index'])->name('receipts');
        });

        Route::get('/notifications', [InvestorDashboardController::class, 'index'])->name('notifications');
        Route::get('/support', [InvestorDashboardController::class, 'index'])->name('support');

        Route::prefix('profile')->name('profile.')->group(function () {
            Route::get('/info', [ProfileController::class, 'edit'])->name('info');
            Route::get('/bank', [ProfileController::class, 'edit'])->name('bank');
            Route::get('/security', [ProfileController::class, 'edit'])->name('security');
        });
    });

    // Investor Registration
    Route::get('/investor/register', [\App\Http\Controllers\InvestorRegistrationController::class, 'create'])->name('investor.register.create');
    Route::post('/investor/register', [\App\Http\Controllers\InvestorRegistrationController::class, 'store'])->name('investor.register.store');
});

// React Application Entry Points
Route::get('/admin-panel/{any?}', function () {
    return view('app');
})->middleware(['auth'])->where('any', '.*')->name('admin-panel');

Route::get('/investor-portal/{any?}', function () {
    return view('app');
})->middleware(['auth'])->where('any', '.*')->name('investor-portal');

Route::get('/client-portal/{any?}', function () {
    return view('app');
})->middleware(['auth'])->where('any', '.*')->name('client-portal');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
