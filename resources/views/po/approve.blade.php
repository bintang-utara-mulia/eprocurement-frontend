@extends('layouts.app')

@section('title', 'Otorisasi PO')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Otorisasi PO</h1>
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

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible show fade">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert"><span>&times;</span></button>
                    <ul class="mb-0 pl-3">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h4>Daftar PO Menunggu Otorisasi Keuangan</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-md">
                        <thead>
                            <tr>
                                <th>No. PO</th>
                                <th>Vendor</th>
                                <th>Total Value</th>
                                <th>Tanggal Diterbitkan</th>
                                <th>Status</th>
                                <th style="min-width: 320px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pos as $po)
                                <tr>
                                    <td><strong>{{ $po->number }}</strong></td>
                                    <td>{{ $po->vendor->name ?? '-' }}</td>
                                    <td>Rp {{ number_format($po->total, 0, ',', '.') }}</td>
                                    <td>{{ $po->issued_at ? \Carbon\Carbon::parse($po->issued_at)->format('d/m/Y') : '-' }}</td>
                                    <td><span class="badge badge-warning">Pending Authorization</span></td>
                                    <td>
                                        <form action="{{ route('po.decision', $po->id) }}" method="POST">
                                            @csrf
                                            <input type="text" name="authorization_note" class="form-control form-control-sm mb-2"
                                                   placeholder="Catatan (opsional)">
                                            <button type="submit" name="decision" value="approve" class="btn btn-success btn-sm"
                                                    onclick="return confirm('Setujui PO {{ $po->number }}?')">
                                                <i class="fas fa-check"></i> Setujui
                                            </button>
                                            <button type="submit" name="decision" value="reject" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Tolak PO {{ $po->number }}?')">
                                                <i class="fas fa-times"></i> Tolak
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted">Tidak ada PO yang menunggu otorisasi.</td>
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