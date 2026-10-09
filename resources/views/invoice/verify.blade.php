@extends('layouts.app')

@section('title', 'Verifikasi 3-Way Matching')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Verifikasi Invoice (3-Way Matching)</h1>
    </div>

    <div class="section-body">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible show fade">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert"><span>&times;</span></button>
                    {{ session('success') }}
                </div>
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h4>Pemeriksaan Komparasi (PO vs GR vs Invoice)</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-md">
                        <thead>
                            <tr>
                                <th>No. Invoice</th>
                                <th>Vendor</th>
                                <th>Nilai PO</th>
                                <th>Penerimaan (GR)</th>
                                <th>Nilai Invoice</th>
                                <th>Status Match</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($invoices as $inv)
                                @php
                                    $po = $inv->po;
                                    $grs = $po ? $po->goodsReceipts : collect();
                                    $grVerified = $grs->where('status', 'verified')->isNotEmpty();
                                    $grQty = $grs->sum('quantity');
                                    $valueMatch = $po && (float) $po->total == (float) $inv->amount;
                                    $fullMatch = $valueMatch && $grVerified;
                                @endphp
                                <tr>
                                    <td><strong>{{ $inv->number }}</strong></td>
                                    <td>{{ $po->vendor->name ?? '-' }}</td>
                                    <td>
                                        Rp {{ number_format($po->total ?? 0, 0, ',', '.') }}
                                        <br><small class="text-muted">({{ $po->number ?? '-' }})</small>
                                    </td>
                                    <td>
                                        @if($grVerified)
                                            {{ $grQty }} Unit
                                            <br><small class="text-success">Terverifikasi</small>
                                        @else
                                            <span class="text-danger">Belum ada GR</span>
                                        @endif
                                    </td>
                                    <td>Rp {{ number_format($inv->amount, 0, ',', '.') }}</td>
                                    <td>
                                        @if($fullMatch)
                                            <span class="badge badge-success">3-Way Match Cocok</span>
                                        @elseif(!$valueMatch)
                                            <span class="badge badge-danger">Nilai Tidak Sama</span>
                                        @else
                                            <span class="badge badge-warning">GR Belum Verified</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <form action="{{ route('invoice.verify.store', $inv->id) }}" method="POST"
                                              onsubmit="return confirm('Proses verifikasi invoice {{ e($inv->number) }}?')">
                                            @csrf
                                            <button type="submit" class="btn btn-primary btn-sm">
                                                <i class="fas fa-check-double"></i> Verifikasi
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted">Tidak ada invoice yang menunggu verifikasi.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection