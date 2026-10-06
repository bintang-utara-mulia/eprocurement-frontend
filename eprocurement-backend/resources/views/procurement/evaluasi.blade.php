@extends('layouts.app')

@section('title', 'Evaluasi & Penetapan Pemenang')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Evaluasi & Penetapan Pemenang Lelang</h1>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Daftar Penawaran Masuk (RFQ-2026-0001)</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Nama Vendor</th>
                                <th>Harga Penawaran</th>
                                <th>Dokumen Penawaran</th>
                                <th>Status Evaluasi</th>
                                <th class="text-center" style="width: 200px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>PT Mitra Gemilang</td>
                                <td>Rp 11.800.000</td>
                                <td><a href="#" class="btn btn-sm btn-info"><i class="fas fa-file-pdf"></i> Lihat Dokumen</a></td>
                                <td><span class="badge badge-warning">Perlu Evaluasi</span></td>
                                <td class="text-center text-nowrap">
                                    <button class="btn btn-sm btn-success" onclick="alert('PT Mitra Gemilang Ditetapkan Sebagai Pemenang!')"><i class="fas fa-trophy"></i> Pilih Pemenang</button>
                                </td>
                            </tr>
                            <tr>
                                <td>CV Nusa Raya</td>
                                <td>Rp 12.200.000</td>
                                <td><a href="#" class="btn btn-sm btn-info"><i class="fas fa-file-pdf"></i> Lihat Dokumen</a></td>
                                <td><span class="badge badge-secondary">Kandidat</span></td>
                                <td class="text-center text-nowrap">
                                    <button class="btn btn-sm btn-outline-success" onclick="alert('Ditetapkan sebagai pemenang alternatif')"><i class="fas fa-check"></i> Pilih</button>
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