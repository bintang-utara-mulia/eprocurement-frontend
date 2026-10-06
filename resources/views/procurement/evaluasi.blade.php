@extends('layouts.app')

@section('title', 'Evaluasi & Penetapan Pemenang')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Evaluasi & Penetapan Pemenang</h1>
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

        @forelse($rfqs as $rfq)
            @php
                $hasWinner = $rfq->quotations->contains('status', 'winner');
                $lowestPrice = $rfq->quotations->min('price');
            @endphp

            <div class="card">
                <div class="card-header">
                    <h4>
                        Daftar Penawaran Masuk ({{ $rfq->number }})
                        @if($rfq->pr?->description)
                            <small class="text-muted"> - {{ $rfq->pr->description }}</small>
                        @endif
                    </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-md">
                            <thead>
                                <tr>
                                    <th>Nama Vendor</th>
                                    <th>Harga Penawaran</th>
                                    <th>Dokumen Penawaran</th>
                                    <th>Status Evaluasi</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($rfq->quotations as $q)
                                    <tr>
                                        <td>{{ $q->vendor->name ?? '-' }}</td>
                                        <td>
                                            Rp {{ number_format($q->price, 0, ',', '.') }}
                                            @if($q->price == $lowestPrice && $rfq->quotations->count() > 1)
                                                <span class="badge badge-info ml-1">Terendah</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($q->document_path)
                                                <a href="{{ asset('storage/' . $q->document_path) }}" target="_blank" class="btn btn-info btn-sm">
                                                    <i class="fas fa-file-pdf"></i> Lihat Dokumen
                                                </a>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($q->status === 'winner')
                                                <span class="badge badge-success">Pemenang</span>
                                            @elseif($q->status === 'rejected')
                                                <span class="badge badge-secondary">Tidak Terpilih</span>
                                            @else
                                                <span class="badge badge-warning">Perlu Evaluasi</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($q->status === 'winner')
                                                <i class="fas fa-trophy text-warning"></i> Ditetapkan
                                            @elseif($hasWinner)
                                                <span class="text-muted">-</span>
                                            @else
                                                <form action="{{ route('quotation.winner', $q->id) }}" method="POST"
                                                      onsubmit="return confirm('Tetapkan {{ e($q->vendor->name ?? 'vendor ini') }} sebagai pemenang?')">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success btn-sm">
                                                        <i class="fas fa-trophy"></i> Pilih Pemenang
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @empty
            <div class="card">
                <div class="card-body text-center text-muted">
                    Belum ada penawaran masuk dari vendor.
                </div>
            </div>
        @endforelse
    </div>
</section>
@endsection