@extends('layouts.app')

@section('title', 'Otorisasi PO')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Otorisasi Purchase Order (PO)</h1>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Daftar PO Menunggu Otorisasi Keuangan</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No. PO</th>
                                <th>Vendor</th>
                                <th>Total Value</th>
                                <th>Tanggal Diterbitkan</th>
                                <th>Status</th>
                                <th class="text-center" style="width: 180px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>PO-2026-0089</td>
                                <td>PT Mitra Gemilang</td>
                                <td>Rp 11.800.000</td>
                                <td>2026-09-29</td>
                                <td><span class="badge badge-warning">Pending Authorization</span></td>
                                <td class="text-center text-nowrap">
                                    <div class="d-flex justify-content-center align-items-center" style="gap: 5px;">
                                        <button class="btn btn-sm btn-success" onclick="alert('PO Berhasil Diotorisasi!')"><i class="fas fa-check"></i> Setujui</button>
                                        <button class="btn btn-sm btn-danger" onclick="alert('PO Ditolak!')"><i class="fas fa-times"></i> Tolak</button>
                                    </div>
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