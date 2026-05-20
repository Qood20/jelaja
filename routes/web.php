<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\FinancialReportController;
use App\Http\Controllers\Admin\OperatorApprovalController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Buyer\DashboardController as BuyerDashboardController;
use App\Http\Controllers\Buyer\DestinationController as BuyerDestinationController;
use App\Http\Controllers\Buyer\TicketController;
use App\Http\Controllers\Buyer\TransactionController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\MidtransWebhookController;
use App\Http\Controllers\Operator\DashboardController as OperatorDashboardController;
use App\Http\Controllers\Operator\DestinationController as OperatorDestinationController;
use App\Http\Controllers\Operator\GalleryController;
use App\Http\Controllers\Operator\ScannerController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', LandingController::class)->name('landing');
Route::get('/kontak', [ContactController::class, 'index'])->name('contact');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::post('/payments/webhook', [MidtransWebhookController::class, 'handle'])->name('payments.webhook');

// Midtrans redirect callbacks (agar user balik ke website, bukan halaman Midtrans)
Route::get('/payments/midtrans/finish', [\App\Http\Controllers\MidtransCallbackController::class, 'finish'])->name('payments.midtrans.finish');
Route::get('/payments/midtrans/unfinish', [\App\Http\Controllers\MidtransCallbackController::class, 'unfinish'])->name('payments.midtrans.unfinish');

Route::get('/dashboard', function () {
    $role = Auth::user()?->role ?? 'buyer';

    return match ($role) {
        'admin' => redirect()->route('admin.dashboard'),
        'operator' => redirect()->route('operator.dashboard'),
        default => redirect()->route('buyer.dashboard'),
    };
})->middleware('auth')->name('dashboard.redirect');

// Halaman Wisata (Public)
Route::get('/wisata', [BuyerDestinationController::class, 'index'])->name('destinations.index');
Route::get('/wisata/{destination}', [BuyerDestinationController::class, 'show'])->name('destinations.show');

Route::prefix('buyer')->middleware(['auth', 'role:buyer'])->name('buyer.')->group(function () {
    Route::get('/dashboard', [BuyerDashboardController::class, 'index'])->name('dashboard');
    Route::post('/wisata/{destination}/checkout', [PaymentController::class, 'confirm'])->name('checkout');
    Route::post('/wisata/{destination}/checkout/confirm', [PaymentController::class, 'checkout'])->name('checkout.confirm');
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::get('/payments/simulate-success/{order_id}', [PaymentController::class, 'simulateSuccess'])->name('payments.simulate.success');
    Route::get('/tiket-saya', [TicketController::class, 'index'])->name('tickets.index');
    Route::get('/tiket-saya/{ticket}', [TicketController::class, 'show'])->name('tickets.show');
    Route::get('/tiket-saya/{ticket}/download', [TicketController::class, 'download'])->name('tickets.download');
    Route::get('/transaksi/{transaction}/status', [TicketController::class, 'checkTransactionStatus'])->name('transactions.check-status');
});

Route::prefix('operator')->middleware(['auth', 'role:operator', 'verified_operator'])->name('operator.')->group(function () {
    Route::get('/dashboard', [OperatorDashboardController::class, 'index'])->name('dashboard');
    Route::resource('/destinations', OperatorDestinationController::class);
    Route::get('/destinations/{destination}/galleries', [GalleryController::class, 'index'])->name('galleries.index');
    Route::get('/destinations/{destination}/galleries/create', [GalleryController::class, 'create'])->name('galleries.create');
    Route::post('/destinations/{destination}/galleries', [GalleryController::class, 'store'])->name('galleries.store');
    Route::delete('/destinations/{destination}/galleries/{gallery}', [GalleryController::class, 'destroy'])->name('galleries.destroy');
    Route::get('/scanner', [ScannerController::class, 'index'])->name('scanner.index');
    Route::post('/scanner/verify', [ScannerController::class, 'verify'])->name('scanner.verify');
});

Route::prefix('admin')->middleware(['auth', 'role:admin'])->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('/users', UserManagementController::class);

    // Admin dapat mengelola destinasi seluruh operator
    Route::get('/destinations', [\App\Http\Controllers\Operator\DestinationController::class, 'index'])->name('destinations.index');
    Route::get('/destinations/create', [\App\Http\Controllers\Operator\DestinationController::class, 'create'])->name('destinations.create');
    Route::post('/destinations', [\App\Http\Controllers\Operator\DestinationController::class, 'store'])->name('destinations.store');
    Route::get('/destinations/{destination}', [\App\Http\Controllers\Operator\DestinationController::class, 'show'])->name('destinations.show');
    Route::get('/destinations/{destination}/edit', [\App\Http\Controllers\Operator\DestinationController::class, 'edit'])->name('destinations.edit');
    Route::put('/destinations/{destination}', [\App\Http\Controllers\Operator\DestinationController::class, 'update'])->name('destinations.update');
    Route::delete('/destinations/{destination}', [\App\Http\Controllers\Operator\DestinationController::class, 'destroy'])->name('destinations.destroy');

    Route::get('/operators/pending', [OperatorApprovalController::class, 'index'])->name('operators.pending');
    Route::post('/operators/{operator}/approve', [OperatorApprovalController::class, 'approve'])->name('operators.approve');
    Route::post('/operators/{operator}/reject', [OperatorApprovalController::class, 'reject'])->name('operators.reject');
    Route::get('/reports/finance', [FinancialReportController::class, 'index'])->name('reports.finance');
});
