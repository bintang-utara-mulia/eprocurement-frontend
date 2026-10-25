<?php

use Illuminate\Support\Facades\Route; 
use App\Http\Controllers\{AuthController, ProcurementController};

// Redirect Halaman Utama
Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Guest Routes (Login)
Route::middleware('guest')->group(function(){
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
});

// Logout Route
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Authenticated Routes (Harus Login)
Route::middleware('auth')->group(function(){
    
    // Dashboard untuk Semua User
    Route::get('/dashboard', [ProcurementController::class, 'dashboard'])->name('dashboard');

    // -------------------------------------------------------------
    // 1. HAK AKSES: PROCUREMENT STAFF
    // -------------------------------------------------------------
    Route::middleware('role:procurement,staff,admin')->group(function(){
        // PR Creation
        Route::prefix('pr')->name('pr.')->group(function(){
            Route::get('/create', [ProcurementController::class, 'createPr'])->name('create');
            Route::post('/create', [ProcurementController::class, 'storePr'])->name('store');
            Route::get('/my-requests', fn() => redirect()->route('dashboard'))->name('my-requests');
            Route::get('/{pr}/ai-recommend', [ProcurementController::class, 'recommendVendors'])->name('ai_recommend');
        });

        // RFQ Management
        Route::prefix('rfq')->name('rfq.')->group(function(){
            Route::get('/create', [ProcurementController::class, 'createRfq'])->name('create');
            Route::post('/create', [ProcurementController::class, 'storeRfq'])->name('store');
            Route::post('/ai-store', [ProcurementController::class, 'storeRfqAi'])->name('ai_store');
            Route::get('/publish', fn() => redirect()->route('rfq.create'))->name('publish');
        });

        // Evaluasi & Winner
        Route::get('/evaluasi-penawaran', [ProcurementController::class, 'evaluation'])->name('evaluasi.index'); 
        Route::post('/quotation/{quotation}/winner', [ProcurementController::class, 'chooseWinner'])->name('quotation.winner');

        // PO Creation
        Route::prefix('po')->name('po.')->group(function(){
            Route::get('/create', [ProcurementController::class, 'createPo'])->name('create');
            Route::post('/create', [ProcurementController::class, 'storePo'])->name('store');
        });
    });

    // -------------------------------------------------------------
    // 2. HAK AKSES: LOGISTIK & GUDANG
    // -------------------------------------------------------------
    Route::middleware('role:procurement,warehouse,gudang,warehouse_staff,petugas_gudang,user,admin')->group(function(){
        Route::prefix('gr')->name('gr.')->group(function(){
            Route::get('/create', [ProcurementController::class, 'createGr'])->name('create');
            Route::post('/create', [ProcurementController::class, 'storeGr'])->name('store');
        });
    });

    // -------------------------------------------------------------
    // 3. HAK AKSES: KEUANGAN / FINANCE
    // -------------------------------------------------------------
    Route::middleware('role:procurement,finance,finance.auth,finance_staff,pejabat_keuangan,unit_keuangan,keuangan,admin')->group(function(){
        Route::prefix('invoice')->name('invoice.')->group(function(){
            Route::get('/verify', [ProcurementController::class, 'verifyInvoices'])->name('verify');
            Route::post('/{invoice}/verify', [ProcurementController::class, 'verifyInvoice'])->name('verify.store');
        });
    });

    // -------------------------------------------------------------
    // 4. HAK AKSES: APPROVER / SUPERVISOR / MANAGEMENT / ADMIN
    // -------------------------------------------------------------
    Route::middleware('role:approver,supervisor,management,admin')->group(function(){
        Route::get('/pr/approval-l1', [ProcurementController::class, 'approvals'])->defaults('level', 1)->name('pr.approval-l1'); 
        Route::get('/pr/approval-l2', [ProcurementController::class, 'approvals'])->defaults('level', 2)->name('pr.approval-l2'); 
        Route::post('/pr/{pr}/decision', [ProcurementController::class, 'decidePr'])->name('pr.decision');
        
        Route::get('/po/approve', [ProcurementController::class, 'poApprovals'])->name('po.approve'); 
        Route::post('/po/{po}/decision', [ProcurementController::class, 'decidePo'])->name('po.decision');
    });

    // -------------------------------------------------------------
    // 5. HAK AKSES: VENDOR STAFF
    // -------------------------------------------------------------
    Route::middleware('role:vendor,admin')->group(function(){
        Route::prefix('vendor')->name('vendor.')->group(function(){
            Route::get('/quotation', [ProcurementController::class, 'quotations'])->name('quotation.upload');
            Route::post('/quotation', [ProcurementController::class, 'storeQuotation'])->name('quotation.store');
            Route::get('/invoice', [ProcurementController::class, 'createInvoice'])->name('invoice.send');
            Route::post('/invoice', [ProcurementController::class, 'storeInvoice'])->name('invoice.store');
        });
    });

    // -------------------------------------------------------------
    // 6. MASTER DATA
    // -------------------------------------------------------------
    Route::middleware('role:procurement,admin')->group(function(){
        Route::get('/items', [ProcurementController::class, 'items'])->name('items.index');
        Route::get('/departments', [ProcurementController::class, 'departments'])->name('departments.index');
        Route::get('/users', [ProcurementController::class, 'users'])->name('users.index');
    });
});