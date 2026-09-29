@extends('layouts.app')

@section('title', 'Kirim Invoice Vendor')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Kirim Invoice Tagihan</h1>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Form Pengajuan Tagihan / Invoice</h4>
            </div>
            <div class="card-body">
                <form action="#" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Pilih PO Terkait</label>
                            <select class="form-control" required>
                                <option value="1">PO-2026-0089 - PT Mitra Gemilang (Rp 11.800.000)</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Nomor Invoice Vendor</label>
                            <input type="text" class="form-control" placeholder="Contoh: INV/MG/2026/091" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Nominal Tagihan (IDR)</label>
                            <input type="number" class="form-control" value="11800000" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Unggah Dokumen Invoice (PDF)</label>
                            <input type="file" class="form-control" accept=".pdf" required>
                        </div>
                    </div>

                    <div class="text-right">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Kirim Tagihan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection