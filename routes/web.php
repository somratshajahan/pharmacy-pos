<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\POSController;
use App\Http\Controllers\ProductReturnController;
use App\Http\Controllers\SaleController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/dashboard');
Route::get('/l', [DashboardController::class, 'start'])->name('start');
Route::post('/login', [DashboardController::class, 'login'])->name('login');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/lowStock/search', [DashboardController::class, 'lowStock'])->name('lowStock');
Route::get('/upcomingExpiry/search', [DashboardController::class, 'upcomingExpiry'])->name('upcomingExpiry');

Route::post('/expense/store', [DashboardController::class, 'expense_store'])->name('expense.store');

Route::get('/pos', [POSController::class, 'index'])->name('pos.index');
Route::get('/pos/search', [POSController::class, 'search'])->name('pos.search');

Route::post('/sale', [SaleController::class, 'store'])->name('sales.store');
Route::post('/product-returns', [ProductReturnController::class, 'store'])->name('product-returns.store');

Route::get('/invoice/{sale}', [InvoiceController::class, 'show'])->name('invoice.show');
Route::get('/invoice/{sale}/pdf', [InvoiceController::class, 'pdf'])->name('invoice.pdf');


Route::get('/medicines', [MedicineController::class, 'index'])->name('medicines.index');
Route::get('/medicines/search', [MedicineController::class, 'search'])->name('medicines.search');
Route::get('/medicines/suggestions', [MedicineController::class, 'suggestions'])->name('medicines.suggestions');
Route::post('/medicines', [MedicineController::class, 'store'])->name('medicines.store');
Route::put('/medicines/{id}/update', [MedicineController::class, 'update'])->name('medicines.update');
Route::delete('/medicines/{id}/delete', [MedicineController::class, 'delete']);

Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
Route::post('/customers', [CustomerController::class, 'store'])->name('customers.store');
Route::post('/customer/storeAjax', [CustomerController::class, 'storeAjax']);
Route::get('/customers/search', [CustomerController::class, 'search']);
Route::get('/customers/search2', [CustomerController::class, 'search2']);
Route::get('/customers/{customer}', [CustomerController::class, 'show'])->name('customers.show');
Route::post('/customers/{customer}/payment', [CustomerController::class, 'addPayment'])->name('customers.payment');
Route::get('/customers/{customerId}/edit', [CustomerController::class, 'edit']);
Route::post('/customer/update/{id}', [CustomerController::class, 'update']);

Route::get('/expense', [ExpenseController::class, 'index'])->name('expense');
Route::get('/expenses/search', [ExpenseController::class, 'search']);