@extends('layouts.app')

@section('title', 'Data Master Items')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Data Master Items (Barang)</h1>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Daftar Barang Procurement</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 50px;">#</th>
                                <th>Nama Barang / Item</th>
                                <th>Kode Barang</th>
                                <th>Satuan</th>
                                <th>Harga Estimasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($items as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->name ?? '-' }}</td>
                                    <td>{{ $item->code ?? '-' }}</td>
                                    <td>{{ $item->unit ?? '-' }}</td>
                                    <td>Rp {{ number_format($item->price ?? 0, 0, ',', '.') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">Belum ada data barang di database.</td>
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