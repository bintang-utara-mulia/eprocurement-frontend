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
                <form action="#" method="POST">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Pilih RFQ & Pemenang</label>
                            <select class="form-control" required>
                                <option value="1">RFQ-2026-0001 - PT Mitra Gemilang (Rp 11.800.000)</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Nomor PO Auto-Generate</label>
                            <input type="text" class="form-control" value="PO-2026-0089" readonly>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Tanggal Diterbitkan</label>
                            <input type="date" class="form-control" value="{{ date('Y-m-d') }}" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Estimasi Tanggal Pengiriman</label>
                            <input type="date" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Syarat & Ketentuan Pembayaran (Terms of Payment)</label>
                        <textarea class="form-control" rows="3">Pembayaran akan dilakukan setelah barang diterima full (GR) dan verifikasi invoice 3-Way Matching selesai.</textarea>
                    </div>

                    <div class="text-right">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Ajukan Otorisasi PO</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection