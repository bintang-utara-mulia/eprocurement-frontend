@extends('layouts.app')

@section('title', 'Penerimaan Barang (GR)')

@section('content')
<section class="section">
@if(session("success"))<div class="alert alert-success">{{ session("success") }}</div>@endif
@if($errors->any())<div class="alert alert-danger">{{ $errors->first() }}</div>@endif
    <div class="section-header">
        <h1>Catat Penerimaan Barang (GR)</h1>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Form Goods Receive (Gudang)</h4>
            </div>
            <div class="card-body">
                <form action="#" method="POST">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Pilih PO Resmi (Terotorisasi)</label>
                            <select class="form-control" required>
                                <option value="1">PO-2026-0089 - PT Mitra Gemilang</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Nomor Surat Jalan Vendor</label>
                            <input type="text" class="form-control" placeholder="Contoh: SJ-MG-2026-99" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Jumlah Barang Diterima (Qty)</label>
                            <input type="number" class="form-control" value="1" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Kondisi Fisik Barang</label>
                            <select class="form-control" required>
                                <option value="good">Baik & Sesuai Spesifikasi</option>
                                <option value="damaged">Ada Cacat / Ditolak Sebagian</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Catatan Pemeriksaan Fisik</label>
                        <textarea class="form-control" rows="3" placeholder="Pemeriksaan fisik barang oleh tim gudang..."></textarea>
                    </div>

                    <div class="text-right">
                        <button type="submit" class="btn btn-success"><i class="fas fa-boxes"></i> Simpan GR (Verified)</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection