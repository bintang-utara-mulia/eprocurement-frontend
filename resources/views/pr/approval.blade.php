@extends('layouts.app')

@section('title', 'Persetujuan Purchase Requisition')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Persetujuan Purchase Requisition (PR)</h1>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Daftar PR Menunggu Persetujuan</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No. PR</th>
                                <th>Pemohon / Dept</th>
                                <th>Deskripsi Kebutuhan</th>
                                <th>Total Nominal</th>
                                <th>Tingkat Approval</th>
                                <th>Status</th>
                                <th class="text-center" style="width: 180px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Contoh PR <= 50JT (Cukup Supervisor / Level 1) -->
                            <tr>
                                <td>PR-2026-001</td>
                                <td>User IT / IT Dept</td>
                                <td>Pengadaan Printer Kantor</td>
                                <td>Rp 12.500.000</td>
                                <td><span class="badge badge-info">Level 1 (<=50JT)</span></td>
                                <td><span class="badge badge-warning">Pending Approval L1</span></td>
                                <td class="text-center text-nowrap">
                                    <div class="d-flex justify-content-center align-items-center" style="gap: 5px;">
                                        <button class="btn btn-sm btn-success" onclick="alert('PR Disetujui!')"><i class="fas fa-check"></i> Setujui</button>
                                        <button class="btn btn-sm btn-danger" onclick="alert('PR Ditolak!')"><i class="fas fa-times"></i> Tolak</button>
                                    </div>
                                </td>
                            </tr>
                            <!-- Contoh PR > 50JT (Wajib Supervisor + Management / Level 2) -->
                            <tr>
                                <td>PR-2026-002</td>
                                <td>User Ops / Operasional</td>
                                <td>Pengadaan Server RACK 2U</td>
                                <td>Rp 85.000.000</td>
                                <td><span class="badge badge-primary">Level 2 (>50JT)</span></td>
                                <td><span class="badge badge-warning">Pending Approval L2</span></td>
                                <td class="text-center text-nowrap">
                                    <div class="d-flex justify-content-center align-items-center" style="gap: 5px;">
                                        <button class="btn btn-sm btn-success" onclick="alert('PR Disetujui!')"><i class="fas fa-check"></i> Setujui</button>
                                        <button class="btn btn-sm btn-danger" onclick="alert('PR Ditolak!')"><i class="fas fa-times"></i> Tolak</button>
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