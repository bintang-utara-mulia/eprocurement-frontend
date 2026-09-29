@extends('layouts.app')

@section('title', 'Unggah Penawaran Vendor')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Unggah Penawaran (Quotation)</h1>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Form Pengajuan Harga & Dokumen Penawaran</h4>
            </div>
            <div class="card-body">
                <form action="#" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Pilih RFQ Aktif</label>
                            <select class="form-control" required>
                                <option value="">-- Pilih Paket RFQ --</option>
                                <option value="1">RFQ-2026-0001 - Pengadaan Printer Kantor</option>
                                <option value="2">RFQ-2026-0002 - Pengadaan Server RACK 2U</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Nama Perusahaan / Vendor</label>
                            <input type="text" class="form-control" value="PT Mitra Gemilang" readonly>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Harga Penawaran (Offered Price - IDR)</label>
                            <input type="number" class="form-control" placeholder="Contoh: 11800000" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Unggah Dokumen Penawaran (PDF)</label>
                            <input type="file" class="form-control" accept=".pdf" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Catatan Penawaran / Spesifikasi Barang</label>
                        <textarea class="form-control" rows="3" placeholder="Tuliskan detail barang, garansi, dan lama waktu pengerjaan/pengiriman..."></textarea>
                    </div>

                    <div class="text-right">
                        <button type="reset" class="btn btn-secondary">Reset</button>
                        <button type="submit" class="btn btn-success"><i class="fas fa-upload"></i> Kirim Penawaran</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection