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
