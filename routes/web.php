<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - E-Procurement System (Final Front-End)
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('welcome');
})->name('dashboard');

// 1. REQUISITION (PR)
Route::prefix('pr')->name('pr.')->group(function () {
    Route::get('/create', fn() => view('pr.create'))->name('create');
    Route::get('/my-requests', fn() => view('welcome'))->name('my-requests');
    Route::get('/approval-l1', fn() => view('pr.approval'))->name('approval11');
    Route::get('/approval-l2', fn() => view('pr.approval'))->name('approval12');
});

// 2. RFQ & EVALUASI
Route::prefix('rfq')->name('rfq.')->group(function () {
    Route::get('/create', fn() => view('rfq.create'))->name('create');
    Route::get('/publish', fn() => view('rfq.create'))->name('publish');
});

Route::get('/evaluasi-penawaran', fn() => view('procurement.evaluasi'))->name('evaluasi.index');

// 3. PURCHASE ORDER (PO)
Route::prefix('po')->name('po.')->group(function () {
    Route::get('/create', fn() => view('po.create'))->name('create');
    Route::get('/approve', fn() => view('po.approve'))->name('approve');
});

// 4. VENDOR AREA
Route::prefix('vendor')->name('vendor.')->group(function () {
    Route::get('/quotation', fn() => view('vendor.quotation'))->name('quotation.upload');
    Route::get('/invoice', fn() => view('vendor.invoice'))->name('invoice.send');
});

// 5. GOODS RECEIVE (GR)
Route::prefix('gr')->name('gr.')->group(function () {
    Route::get('/create', fn() => view('gr.create'))->name('create');
});

// 6. KEUANGAN & MATCHING
Route::prefix('invoice')->name('invoice.')->group(function () {
    Route::get('/verify', fn() => view('invoice.verify'))->name('verify');
});

// 7. MASTER DATA
Route::get('/items', fn() => view('welcome'))->name('items.index');
Route::get('/departments', fn() => view('welcome'))->name('departments.index');
Route::get('/users', fn() => view('welcome'))->name('users.index');