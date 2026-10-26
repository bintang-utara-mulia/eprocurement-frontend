<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProcurementController;
use Illuminate\Support\Facades\Route;

Route::get('/health', fn () => response()->json(['status' => 'ok', 'service' => 'eprocurement-backend']))->name('api.health');

Route::middleware('web')->group(function () {
    Route::post('/login', [AuthController::class, 'login'])->name('api.login');

    Route::middleware('auth')->group(function () {
        Route::get('/me', [AuthController::class, 'me'])->name('api.me');
        Route::post('/logout', [AuthController::class, 'logout'])->name('api.logout');

        Route::get('/dashboard', [ProcurementController::class, 'dashboard'])->name('api.dashboard');
        Route::get('/prs', [ProcurementController::class, 'prs'])->name('api.prs.index');
        Route::post('/prs', [ProcurementController::class, 'storePr'])->middleware('role:user_internal')->name('api.prs.store');
        Route::get('/prs/approvals/{level}', [ProcurementController::class, 'approvals'])->middleware('role:supervisor,management')->name('api.prs.approvals');
        Route::post('/prs/{pr}/decision', [ProcurementController::class, 'decidePr'])->middleware('role:supervisor,management')->name('api.prs.decision');

        Route::get('/rfqs', [ProcurementController::class, 'rfqs'])->name('api.rfqs.index');
        Route::post('/rfqs', [ProcurementController::class, 'storeRfq'])->middleware('role:procurement')->name('api.rfqs.store');
        Route::post('/quotations', [ProcurementController::class, 'storeQuotation'])->middleware('role:vendor')->name('api.quotations.store');
        Route::post('/quotations/{quotation}/winner', [ProcurementController::class, 'chooseWinner'])->middleware('role:procurement')->name('api.quotations.winner');

        Route::get('/purchase-orders', [ProcurementController::class, 'purchaseOrders'])->name('api.purchase-orders.index');
        Route::post('/purchase-orders', [ProcurementController::class, 'storePurchaseOrder'])->middleware('role:procurement')->name('api.purchase-orders.store');
        Route::post('/purchase-orders/{po}/decision', [ProcurementController::class, 'decidePurchaseOrder'])->middleware('role:pejabat_keuangan')->name('api.purchase-orders.decision');
        Route::post('/goods-receipts', [ProcurementController::class, 'storeGoodsReceipt'])->middleware('role:petugas_gudang')->name('api.goods-receipts.store');

        Route::get('/invoices', [ProcurementController::class, 'invoices'])->name('api.invoices.index');
        Route::post('/invoices', [ProcurementController::class, 'storeInvoice'])->middleware('role:vendor')->name('api.invoices.store');
        Route::post('/invoices/{invoice}/verify', [ProcurementController::class, 'verifyInvoice'])->middleware('role:unit_keuangan')->name('api.invoices.verify');

        Route::middleware('role:admin')->group(function () {
            Route::get('/items', [ProcurementController::class, 'items'])->name('api.items.index');
            Route::get('/departments', [ProcurementController::class, 'departments'])->name('api.departments.index');
            Route::get('/users', [ProcurementController::class, 'users'])->name('api.users.index');
        });
    });
});
