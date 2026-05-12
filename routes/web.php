<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ConstructionPlanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmailConfigurationController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\FundRequestController;
use App\Http\Controllers\GroupEmailController;
use App\Http\Controllers\InvestmentController;
use App\Http\Controllers\InvestorController;
use App\Http\Controllers\InvestorDashboardController;
use App\Http\Controllers\InvestorRegistrationController;
use App\Http\Controllers\LabourController;
use App\Http\Controllers\LabourWorkProgressController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\MaterialTransactionController;
use App\Http\Controllers\PayoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectPaymentController;
use App\Http\Controllers\ProjectUpdateController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SiteManagerController;
use App\Http\Controllers\TwoFactorController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\WebsiteContentController;
use Illuminate\Support\Facades\Route;

// Public Website Routes (Blade-based)
Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/about', [PublicController::class, 'about'])->name('about');
Route::get('/services', [PublicController::class, 'services'])->name('services');
Route::get('/services/residential-construction', [PublicController::class, 'residentialConstruction'])->name('services.residential');
Route::get('/services/commercial-development', [PublicController::class, 'commercialDevelopment'])->name('services.commercial');
Route::get('/services/industrial-infrastructure', [PublicController::class, 'industrialInfrastructure'])->name('services.industrial');
Route::get('/services/interior-design', [PublicController::class, 'interiorDesign'])->name('services.interior');
Route::get('/services/sustainable-building', [PublicController::class, 'sustainableBuilding'])->name('services.sustainable');
Route::get('/services/project-management', [PublicController::class, 'projectManagement'])->name('services.management');
Route::get('/projects-portfolio', [PublicController::class, 'projects'])->name('projects');
Route::get('/invest', [PublicController::class, 'invest'])->name('public.invest');
Route::get('/contact', [PublicController::class, 'contact'])->name('contact');
Route::get('/team', [PublicController::class, 'team'])->name('team');
Route::get('/testimonials', [PublicController::class, 'testimonials'])->name('testimonials');
Route::get('/privacy-policy', [PublicController::class, 'privacy'])->name('privacy');
Route::get('/terms-and-conditions', [PublicController::class, 'terms'])->name('terms');
Route::get('/faq', [PublicController::class, 'faq'])->name('faq');

// Blog Public Routes
Route::get('/blogs', [BlogController::class, 'publicIndex'])->name('blogs.index');
Route::get('/blogs/{slug}', [BlogController::class, 'publicShow'])->name('blogs.show');

// Auth Routes (handled by Laravel)
require __DIR__.'/auth.php';

Route::middleware(['auth'])->group(function () {
    Route::get('/verify-two-factor', [TwoFactorController::class, 'index'])->name('verify.index');
    Route::post('/verify-two-factor', [TwoFactorController::class, 'store'])->name('verify.store');
    Route::get('/verify-two-factor/resend', [TwoFactorController::class, 'resend'])->name('verify.resend');
});

// Admin Panel Routes (Blade-based)
Route::middleware(['auth', 'two-factor'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Roles & Permissions
    Route::resource('roles', RoleController::class)->middleware('permission:view-users');
    Route::post('/roles/{role}/toggle-status', [RoleController::class, 'toggleStatus'])->name('roles.toggle-status')->middleware('permission:edit-users');

    // Projects
    Route::resource('projects', ProjectController::class);
    Route::resource('project-payments', ProjectPaymentController::class);
    Route::get('project-payments/{project_payment}/receipt', [ProjectPaymentController::class, 'receipt'])->name('project-payments.receipt');
    Route::get('project-payments/{project_payment}/invoice', [ProjectPaymentController::class, 'invoice'])->name('project-payments.invoice');
    Route::get('project-payment-history', [ProjectPaymentController::class, 'history'])->name('project-payments.history');
    Route::get('project-payment-balances', [ProjectPaymentController::class, 'balances'])->name('project-payments.balances');
    Route::resource('project-updates', ProjectUpdateController::class)->middleware('permission:view-media');

    // Expenses
    Route::resource('expenses', ExpenseController::class);

    // Site Manager Work Progress
    Route::get('/site-manager/work-progress', [LabourWorkProgressController::class, 'index'])->name('labour.work-progress.index');
    Route::post('/site-manager/{site_manager}/work-progress', [LabourWorkProgressController::class, 'store'])->name('labour.work-progress.store');
    Route::delete('/site-manager/work-progress/{progress}', [LabourWorkProgressController::class, 'destroy'])->name('labour.work-progress.destroy');

    // Labour & Attendance
    Route::get('/labour/dashboard', [LabourController::class, 'dashboard'])->name('labour.dashboard');
    Route::get('/labour/export', [LabourController::class, 'export'])->name('labour.export');
    Route::post('/labour/import', [LabourController::class, 'import'])->name('labour.import');
    Route::resource('labour', LabourController::class);
    Route::post('/labour/{labour}/payment', [LabourController::class, 'addPayment'])->name('labour.payment.store');
    Route::put('/labour/payment/{attendance}', [LabourController::class, 'updatePayment'])->name('labour.payment.update');
    Route::delete('/labour/payment/{attendance}', [LabourController::class, 'destroyPayment'])->name('labour.payment.destroy');
    Route::get('/labour/{labour}/report', [LabourController::class, 'downloadReport'])->name('labour.report');
    Route::get('/labour/{labour}/download-pdf', [LabourController::class, 'downloadPDF'])->name('labour.download-pdf');
    Route::get('/labour/{labour}/report/pdf', [LabourController::class, 'downloadPDFReport'])->name('labour.report.pdf');
    Route::get('/labour/{labour}/report/excel', [LabourController::class, 'downloadExcelReport'])->name('labour.report.excel');
    Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');
    Route::get('/attendance/create', [AttendanceController::class, 'create'])->name('attendance.create');
    Route::post('/attendance', [AttendanceController::class, 'store'])->name('attendance.store');
    Route::match(['get', 'post'], '/attendance/createsave', [AttendanceController::class, 'store'])->name('attendance.createsave');
    Route::get('/attendance/export', [AttendanceController::class, 'export'])->name('attendance.export');
    Route::get('/attendance/bulk-delete', function () {
        return redirect()->route('attendance.index');
    });
    Route::delete('/attendance/bulk-delete', [AttendanceController::class, 'bulkDelete'])->name('attendance.bulk-delete');
    // POST request is handled as well via standard form upload
    Route::get('/attendance/import', function () {
        return redirect()->route('attendance.index');
    });
    Route::post('/attendance/import', [AttendanceController::class, 'import'])->name('attendance.import');

    // Site Manager Management
    Route::get('/site-managers/dashboard', [SiteManagerController::class, 'dashboard'])->name('site-managers.dashboard');
    Route::get('/site-managers/attendance', [SiteManagerController::class, 'attendance'])->name('site-managers.attendance');
    Route::get('/site-managers/attendance-records', [SiteManagerController::class, 'attendanceRecords'])->name('site-managers.attendance-records');
    Route::post('/site-managers/attendance', [SiteManagerController::class, 'storeAttendance'])->name('site-managers.attendance.store');
    Route::get('/site-managers/payouts', [SiteManagerController::class, 'payouts'])->name('site-managers.payouts.index');
    Route::post('/site-managers/generate-payroll', [SiteManagerController::class, 'generatePayroll'])->name('site-managers.generate-payroll');
    Route::get('/site-managers/export-payroll', [SiteManagerController::class, 'exportPayroll'])->name('site-managers.export-payroll');
    Route::get('/site-managers/export-payroll/pdf', [SiteManagerController::class, 'exportPayrollPDF'])->name('site-managers.export-payroll.pdf');
    Route::get('/site-managers/export-payroll/excel', [SiteManagerController::class, 'exportPayrollExcel'])->name('site-managers.export-payroll.excel');
    Route::get('/site-managers/{site_manager}/report/pdf', [SiteManagerController::class, 'downloadPDFReport'])->name('site-managers.report.pdf');
    Route::get('/site-managers/{site_manager}/report/excel', [SiteManagerController::class, 'downloadExcelReport'])->name('site-managers.report.excel');
    Route::patch('/site-managers/payouts/{payout}/status', [SiteManagerController::class, 'updatePayoutStatus'])->name('site-managers.payouts.update-status');
    Route::get('/site-managers/payouts/{payout}/payslip', [SiteManagerController::class, 'downloadPayslip'])->name('site-managers.download-payslip');
    Route::get('/site-managers/payouts/create', [SiteManagerController::class, 'createPayout'])->name('site-managers.payouts.create');
    Route::post('/site-managers/payouts', [SiteManagerController::class, 'storePayout'])->name('site-managers.payouts.store');
    Route::get('/site-managers/export', [SiteManagerController::class, 'export'])->name('site-managers.export');
    Route::post('/site-managers/import', [SiteManagerController::class, 'import'])->name('site-managers.import');
    Route::resource('site-managers', SiteManagerController::class);

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
    Route::resource('construction-plans', ConstructionPlanController::class);

    // Email Configuration
    Route::get('/email-config', [EmailConfigurationController::class, 'index'])->name('admin.email-config.index');
    Route::patch('/email-config', [EmailConfigurationController::class, 'update'])->name('admin.email-config.update');

    // Group Email
    Route::get('/group-email', [GroupEmailController::class, 'index'])->name('admin.group-email.index');
    Route::post('/group-email', [GroupEmailController::class, 'send'])->name('admin.group-email.send');

    // Blog Management
    Route::resource('admin/blogs', BlogController::class)->names([
        'index' => 'admin.blogs.index',
        'create' => 'admin.blogs.create',
        'store' => 'admin.blogs.store',
        'show' => 'admin.blogs.show',
        'edit' => 'admin.blogs.edit',
        'update' => 'admin.blogs.update',
        'destroy' => 'admin.blogs.destroy',
    ])->parameters([
        'blogs' => 'blog',
    ]);
    Route::post('/admin/blogs/generate', [BlogController::class, 'generate'])->name('admin.blogs.generate');

    // Investor Management
    Route::resource('investors', InvestorController::class);
    Route::get('fund-requests', [FundRequestController::class, 'index'])->name('fund-requests.index');
    // We'll use traditional paths since resource might be too much for just index/approve/reject
    Route::patch('fund-requests/{fundRequest}/approve', [FundRequestController::class, 'approve'])->name('fund-requests.approve');
    Route::patch('fund-requests/{fundRequest}/reject', [FundRequestController::class, 'reject'])->name('fund-requests.reject');

    Route::patch('investments/{investment}/approve', [InvestmentController::class, 'approve'])->name('investments.approve');
    Route::resource('investments', InvestmentController::class);
    Route::patch('payouts/{payout}/approve', [PayoutController::class, 'approve'])->name('payouts.approve');
    Route::resource('payouts', PayoutController::class);

    // Investor Dashboard Routes
    Route::prefix('investor')->name('investor.')->group(function () {
        Route::get('/dashboard', [InvestorDashboardController::class, 'index'])->name('dashboard');
        Route::post('/add-funds', [InvestorDashboardController::class, 'addFunds'])->name('add-funds');

        Route::prefix('wallet')->name('wallet.')->group(function () {
            Route::get('/add-funds', [InvestorDashboardController::class, 'showAddFunds'])->name('add-funds');
        });

        Route::prefix('portfolio')->name('portfolio.')->group(function () {
            Route::get('/overview', [InvestorDashboardController::class, 'portfolioOverview'])->name('overview');
            Route::get('/active', [InvestorDashboardController::class, 'portfolioActive'])->name('active');
            Route::get('/completed', [InvestorDashboardController::class, 'portfolioCompleted'])->name('completed');
        });

        Route::prefix('projects')->name('projects.')->group(function () {
            Route::get('/all', [InvestorDashboardController::class, 'projectsAll'])->name('all');
            Route::get('/performance', [InvestorDashboardController::class, 'projectsPerformance'])->name('performance');
            Route::get('/{id}', [InvestorDashboardController::class, 'projectDetails'])->name('details');
            Route::post('/{id}/invest', [InvestorDashboardController::class, 'storeInvestment'])->name('invest');
        });

        Route::prefix('earnings')->name('earnings.')->group(function () {
            Route::get('/summary', [InvestorDashboardController::class, 'earningsSummary'])->name('summary');
            Route::get('/history', [InvestorDashboardController::class, 'earningsHistory'])->name('history');
            Route::get('/analytics', [InvestorDashboardController::class, 'earningsAnalytics'])->name('analytics');
        });

        Route::prefix('transactions')->name('transactions.')->group(function () {
            Route::get('/all', [InvestorDashboardController::class, 'transactionsAll'])->name('all');
            Route::get('/history', [InvestorDashboardController::class, 'transactionsHistory'])->name('history');
            Route::get('/withdrawals', [InvestorDashboardController::class, 'transactionsWithdrawals'])->name('withdrawals');
        });

        Route::prefix('documents')->name('documents.')->group(function () {
            Route::get('/agreements', [InvestorDashboardController::class, 'documentsAgreements'])->name('agreements');
            Route::get('/reports', [InvestorDashboardController::class, 'documentsReports'])->name('reports');
            Route::get('/receipts', [InvestorDashboardController::class, 'documentsReceipts'])->name('receipts');
        });

        Route::get('/notifications', [InvestorDashboardController::class, 'notifications'])->name('notifications');
        Route::get('/support', [InvestorDashboardController::class, 'support'])->name('support');

        Route::prefix('profile')->name('profile.')->group(function () {
            Route::get('/info', [InvestorDashboardController::class, 'profileInfo'])->name('info');
            Route::post('/info', [InvestorDashboardController::class, 'profileInfoUpdate'])->name('info.update');
            Route::get('/bank', [InvestorDashboardController::class, 'profileBank'])->name('bank');
            Route::post('/bank', [InvestorDashboardController::class, 'profileBankUpdate'])->name('bank.update');
            Route::patch('/bank/{id}/primary', [InvestorDashboardController::class, 'profileBankSetPrimary'])->name('bank.primary');
            Route::delete('/bank/{id}', [InvestorDashboardController::class, 'profileBankDelete'])->name('bank.delete');
            Route::get('/security', [InvestorDashboardController::class, 'profileSecurity'])->name('security');
            Route::post('/security/two-factor', [InvestorDashboardController::class, 'toggleTwoFactor'])->name('security.two-factor');
        });
    });

    // Investor Registration
    Route::get('/investor/register', [InvestorRegistrationController::class, 'create'])->name('investor.register.create');
    Route::post('/investor/register', [InvestorRegistrationController::class, 'store'])->name('investor.register.store');
});

// React Application Entry Points
Route::middleware(['auth', 'two-factor'])->group(function () {
    $reactRoutes = [
        '/admin/dashboard',
        '/users',
        '/leads',
        '/contracts',
        '/plans',
        '/milestones',
        '/finance',
    ];

    foreach ($reactRoutes as $path) {
        Route::get($path, function () {
            return view('app');
        });
    }
});

Route::get('/investor-portal/{any?}', function () {
    return view('app');
})->middleware(['auth', 'two-factor'])->where('any', '.*')->name('investor-portal');

Route::get('/client-portal/{any?}', function () {
    return view('app');
})->middleware(['auth', 'two-factor'])->where('any', '.*')->name('client-portal');

Route::middleware(['auth', 'two-factor'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
