<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FinanceTrackerController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\LanguageController;


Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'ru', 'kk'])) {
        session(['locale' => $locale]);
    }

    return back();
})->name('lang.switch');Route::get('/', [FinanceTrackerController::class, 'landing'])->name('landing');

Route::get('/register', [FinanceTrackerController::class, 'register'])->name('register');
Route::post('/register', [FinanceTrackerController::class, 'registerSubmit'])->name('register.submit');

Route::get('/login', [FinanceTrackerController::class, 'login'])->name('login');
Route::post('/login', [FinanceTrackerController::class, 'loginSubmit'])->name('login.submit');

Route::get('/forgot-password', [FinanceTrackerController::class, 'forgotPassword'])->name('forgot.password');

Route::middleware(['role:owner|accountant|analyst|viewer'])->group(function () {
    Route::get('/dashboard', [FinanceTrackerController::class, 'dashboard'])->name('dashboard');
    Route::get('/transactions/history', [FinanceTrackerController::class, 'transactionsHistory'])->name('transactions.history');
});

Route::middleware(['role:owner|accountant'])->group(function () {
    Route::get('/transactions/add', [FinanceTrackerController::class, 'addTransaction'])->name('transactions.add');
});

Route::middleware(['role:owner|analyst'])->group(function () {
    Route::get('/analytics', [FinanceTrackerController::class, 'analytics'])->name('analytics');
});

Route::middleware(['role:owner|accountant|analyst'])->group(function () {
    Route::get('/reports', [FinanceTrackerController::class, 'reports'])->name('reports');
});

Route::middleware(['role:owner'])->group(function () {
    Route::get('/settings-security', [FinanceTrackerController::class, 'settingsSecurity'])->name('settings.security');
});

Route::get('/categories', [FinanceTrackerController::class, 'categories'])->name('categories');
Route::get('/budgets', [FinanceTrackerController::class, 'budgets'])->name('budgets');
Route::get('/goals-savings', [FinanceTrackerController::class, 'goalsSavings'])->name('goals.savings');
Route::get('/subscriptions', [FinanceTrackerController::class, 'subscriptions'])->name('subscriptions');
Route::get('/income-sources', [FinanceTrackerController::class, 'incomeSources'])->name('income.sources');
Route::get('/notifications', [FinanceTrackerController::class, 'notifications'])->name('notifications');
Route::get('/profile', [FinanceTrackerController::class, 'profile'])->name('profile');
Route::get('/support-faq', [FinanceTrackerController::class, 'supportFaq'])->name('support.faq');
Route::post('/logout', [FinanceTrackerController::class, 'logout'])->name('logout');

Route::get('/files',                 [FileController::class, 'index'])   ->name('files.index');
Route::post('/files',                [FileController::class, 'store'])   ->name('files.store');
Route::get('/files/{file}/download', [FileController::class, 'download'])->name('files.download');
Route::delete('/files/{file}',       [FileController::class, 'destroy']) ->name('files.destroy');

Route::get('/email/compose',  [EmailController::class, 'create'])->name('email.create');
Route::post('/email/compose', [EmailController::class, 'store']) ->name('email.store');
Route::get('/email/sent',     [EmailController::class, 'sent'])  ->name('email.sent'); 


