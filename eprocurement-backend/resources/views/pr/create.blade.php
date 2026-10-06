@extends('layouts.app')

@section('title', 'Buat Draft PR')

@section('content')
<section class="section">
@if(session("success"))<div class="alert alert-success">{{ session("success") }}</div>@endif
@if($errors->any())<div class="alert alert-danger">{{ $errors->first() }}</div>@endif
    <div class="section-header">
        <h1>Buat Draft Purchase Requisition (PR)</h1>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Form Pengajuan Barang / Jasa</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('pr.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Departemen Pemohon</label>
                            <input type="text" class="form-control" value="IT Department" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Tanggal Pengajuan</label>
                            <input type="date" class="form-control" value="{{ date('Y-m-d') }}" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Nama Barang / Deskripsi Requirement</label>
                        <input type="text" name="description" class="form-control" placeholder="Contoh: Laptop Developer High-Spec" required>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-4">
                            <label>Jumlah (Quantity)</label>
                            <input type="number" name="quantity" class="form-control" min="1" value="1" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Satuan (Unit)</label>
                            <input type="text" name="unit" class="form-control" placeholder="Pcs / Unit / Paket" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Estimasi Total Harga (IDR)</label>
                            <input type="number" name="estimated_total" class="form-control" placeholder="Contoh: 15000000" required>
                            <small class="form-text text-muted">
                                *Nominal > 50 Juta akan membutuhkan approval Management (L2).
                            </small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Catatan / Alasan Kebutuhan</label>
                        <textarea name="notes" class="form-control" rows="3" placeholder="Jelaskan kebutuhan pengajuan barang ini..."></textarea>
                    </div>

                    <div class="text-right">
                        <button type="reset" class="btn btn-secondary">Reset</button>
                        <button type="submit" class="btn btn-primary">Simpan Draft PR</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection