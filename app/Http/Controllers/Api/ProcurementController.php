<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\{Department, GoodsReceipt, Invoice, Item, PurchaseOrder, PurchaseRequisition, Quotation, Rfq, User};
use Illuminate\Http\Request;

class ProcurementController extends Controller
{
    public function dashboard()
    {
        return response()->json(['counts' => [
            'pr' => PurchaseRequisition::count(),
            'rfq' => Rfq::count(),
            'po' => PurchaseOrder::count(),
            'invoice' => Invoice::count(),
        ]]);
    }

    public function prs(Request $request)
    {
        $query = PurchaseRequisition::with('user')->latest();
        if ($request->filled('status')) $query->where('status', $request->string('status'));
        return response()->json($query->paginate($request->integer('per_page', 15)));
    }

    public function storePr(Request $request)
    {
        $data = $request->validate([
            'description' => ['required', 'string', 'max:255'],
            'quantity' => ['required', 'integer', 'min:1'],
            'unit' => ['required', 'string', 'max:50'],
            'estimated_total' => ['required', 'numeric', 'min:0'],
            'notes' => ['nullable', 'string'],
        ]);
        $data += [
            'number' => 'PR-'.date('Y').'-'.str_pad((PurchaseRequisition::count() + 1), 4, '0', STR_PAD_LEFT),
            'user_id' => $request->user()->id,
            'department' => $request->user()->department,
            'approval_level' => $data['estimated_total'] > 50000000 ? 2 : 1,
            'status' => 'pending_l1',
        ];
        return response()->json(['data' => PurchaseRequisition::create($data)], 201);
    }

    public function approvals(Request $request, int $level)
    {
        $status = $level === 1 ? 'pending_l1' : 'pending_l2';
        return response()->json(PurchaseRequisition::with('user')->where('status', $status)->latest()->paginate($request->integer('per_page', 15)));
    }

    public function decidePr(Request $request, PurchaseRequisition $pr)
    {
        $data = $request->validate(['decision' => ['required', 'in:approve,reject'], 'reason' => ['nullable', 'string']]);
        $pr->update($data['decision'] === 'reject'
            ? ['status' => 'rejected', 'rejection_reason' => $data['reason'] ?? null]
            : ['status' => $pr->status === 'pending_l1' && $pr->approval_level === 2 ? 'pending_l2' : 'approved']);
        return response()->json(['data' => $pr->fresh()]);
    }

    public function rfqs(Request $request)
    {
        return response()->json(Rfq::with(['pr', 'quotations.vendor'])->latest()->paginate($request->integer('per_page', 15)));
    }

    public function storeRfq(Request $request)
    {
        $data = $request->validate(['pr_id' => ['required', 'exists:purchase_requisitions,id'], 'deadline' => ['required', 'date', 'after_or_equal:today'], 'method' => ['required', 'in:open,limited'], 'specifications' => ['nullable', 'string']]);
        $data += ['number' => 'RFQ-'.date('Y').'-'.str_pad((Rfq::count() + 1), 4, '0', STR_PAD_LEFT), 'created_by' => $request->user()->id, 'status' => 'published'];
        return response()->json(['data' => Rfq::create($data)], 201);
    }

    public function storeQuotation(Request $request)
    {
        $data = $request->validate(['rfq_id' => ['required', 'exists:rfqs,id'], 'price' => ['required', 'numeric', 'min:0'], 'document' => ['required', 'file', 'mimes:pdf', 'max:5120'], 'notes' => ['nullable', 'string']]);
        $data['vendor_id'] = $request->user()->id;
        $data['document_path'] = $request->file('document')->store('quotations', 'public');
        unset($data['document']);
        $data['status'] = 'submitted';
        return response()->json(['data' => Quotation::create($data)], 201);
    }

    public function chooseWinner(Request $request, Quotation $quotation)
    {
        $quotation->rfq->quotations()->where('id', '!=', $quotation->id)->update(['status' => 'rejected']);
        $quotation->update(['status' => 'winner']);
        return response()->json(['data' => $quotation->fresh()]);
    }

    public function purchaseOrders(Request $request)
    {
        return response()->json(PurchaseOrder::with(['vendor', 'rfq', 'goodsReceipts', 'invoices'])->latest()->paginate($request->integer('per_page', 15)));
    }

    public function storePurchaseOrder(Request $request)
    {
        $data = $request->validate(['quotation_id' => ['required', 'exists:quotations,id'], 'delivery_date' => ['required', 'date'], 'payment_terms' => ['required', 'string']]);
        $quotation = Quotation::with('rfq')->findOrFail($data['quotation_id']);
        $data += ['number' => 'PO-'.date('Y').'-'.str_pad((PurchaseOrder::count() + 1), 4, '0', STR_PAD_LEFT), 'rfq_id' => $quotation->rfq_id, 'vendor_id' => $quotation->vendor_id, 'created_by' => $request->user()->id, 'issued_at' => now(), 'total' => $quotation->price, 'status' => 'pending_authorization'];
        return response()->json(['data' => PurchaseOrder::create($data)], 201);
    }

    public function decidePurchaseOrder(Request $request, PurchaseOrder $po)
    {
        $data = $request->validate(['decision' => ['required', 'in:approve,reject'], 'authorization_note' => ['nullable', 'string']]);
        $po->update(['status' => $data['decision'] === 'approve' ? 'authorized' : 'rejected', 'authorization_note' => $data['authorization_note'] ?? null]);
        return response()->json(['data' => $po->fresh()]);
    }

    public function storeGoodsReceipt(Request $request)
    {
        $data = $request->validate(['po_id' => ['required', 'exists:purchase_orders,id'], 'delivery_note' => ['required', 'string'], 'quantity' => ['required', 'integer', 'min:1'], 'condition' => ['required', 'in:good,damaged'], 'notes' => ['nullable', 'string']]);
        $data += ['received_by' => $request->user()->id, 'status' => 'verified'];
        return response()->json(['data' => GoodsReceipt::create($data)], 201);
    }

    public function invoices(Request $request)
    {
        return response()->json(Invoice::with(['po.goodsReceipts', 'po.vendor'])->latest()->paginate($request->integer('per_page', 15)));
    }

    public function storeInvoice(Request $request)
    {
        $data = $request->validate(['po_id' => ['required', 'exists:purchase_orders,id'], 'number' => ['required', 'string', 'max:100'], 'amount' => ['required', 'numeric', 'min:0'], 'document' => ['required', 'file', 'mimes:pdf', 'max:5120']]);
        $data += ['vendor_id' => $request->user()->id, 'document_path' => $request->file('document')->store('invoices', 'public'), 'status' => 'pending_verification'];
        unset($data['document']);
        return response()->json(['data' => Invoice::create($data)], 201);
    }

    public function verifyInvoice(Request $request, Invoice $invoice)
    {
        $match = $invoice->po && $invoice->po->total == $invoice->amount && $invoice->po->goodsReceipts()->where('status', 'verified')->exists();
        $invoice->update(['status' => $match ? 'verified' : 'discrepancy', 'verification_note' => $match ? 'PO, GR, dan invoice cocok.' : 'Terdapat perbedaan nilai atau GR belum verified.']);
        return response()->json(['data' => $invoice->fresh()]);
    }

    public function items() { return response()->json(Item::latest()->get()); }
    public function departments() { return response()->json(Department::latest()->get()); }
    public function users() { return response()->json(User::latest()->get()); }
}
