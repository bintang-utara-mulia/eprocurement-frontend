@extends('layouts.app')

@section('title', 'Verifikasi 3-Way Matching')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Verifikasi Invoice / 3-Way Matching</h1>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Pemeriksaan Komparasi (PO vs GR vs Invoice)</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No. Invoice</th>
                                <th>Nilai PO</th>
                                <th>Penerimaan (GR)</th>
                                <th>Nilai Invoice</th>
                                <th>Status Match</th>
                                <th class="text-center" style="width: 180px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>INV/MG/2026/091</td>
                                <td>Rp 11.800.000 (PO-0089)</td>
                                <td>1 Unit (Lengkap)</td>
                                <td>Rp 11.800.000</td>
                                <td><span class="badge badge-success">3-Way Match Cocok</span></td>
                                <td class="text-center text-nowrap">
                                    <button class="btn btn-sm btn-primary" onclick="alert('Invoice Terverifikasi! Siap untuk Proses Pembayaran.')"><i class="fas fa-check-double"></i> Selesai (Bayar)</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection