@extends('layouts.app')

@section('title', 'Draft Purchase Order')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Draft Purchase Order (PO)</h1>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Form Pembuatan Draft PO</h4>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible show fade">
                        <div class="alert-body">
                            <button class="close" data-dismiss="alert"><span>&times;</span></button>
                            {{ session('success') }}
                        </div>
                    </div>
                @endif

                <form action="{{ route('po.store') }}" method="POST" id="formCreatePo">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Pilih RFQ & Pemenang</label>
                            <select name="quotation_id" class="form-control" required>
                                <option value="">-- Pilih Vendor Pemenang --</option>
                                @foreach($quotations as $q)
                                    <option value="{{ $q->id }}">
                                        {{ $q->rfq->number ?? 'RFQ' }} - {{ $q->vendor->name ?? 'Vendor' }} (Rp {{ number_format($q->price, 0, ',', '.') }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Nomor PO Auto-Generate</label>
                            <input type="text" class="form-control" value="PO-{{ date('Y') }}-{{ str_pad(\App\Models\PurchaseOrder::count() + 1, 4, '0', STR_PAD_LEFT) }}" readonly>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Tanggal Diterbitkan</label>
                            <input type="date" class="form-control" value="{{ date('Y-m-d') }}" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Estimasi Tanggal Pengiriman</label>
                            <input type="date" name="delivery_date" class="form-control" value="{{ date('Y-m-d', strtotime('+7 days')) }}" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Syarat & Ketentuan Pembayaran (Terms of Payment)</label>
                        <textarea name="payment_terms" class="form-control" rows="3" required>Pembayaran akan dilakukan setelah barang diterima full (GR) dan verifikasi invoice 3-Way Matching selesai.</textarea>
                    </div>

                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-paper-plane mr-1"></i> Ajukan Otorisasi PO
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#formCreatePo').on('submit', function(e) {
        let isConfirmed = confirm('Apakah Anda yakin ingin mengajukan Draft PO ini ke Management untuk diotorisasi?');
        if (!isConfirmed) {
            e.preventDefault(); // Batalkan submit jika user memilih Cancel
        }
    });
});
</script>
@endsection