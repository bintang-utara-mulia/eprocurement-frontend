@extends('layouts.app')

@section('title', 'Publikasi RFQ')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Buat & Publikasi RFQ</h1>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Pilih PR yang Sudah Disetujui</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('rfq.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Pilih PR</label>
                        <select name="pr_id" class="form-control" required>
                            @forelse($prs as $pr)
                                <option value="{{ $pr->id }}">{{ $pr->number }} - {{ $pr->description }}</option>
                            @empty
                                <option value="">Belum ada PR yang diapprove</option>
                            @endforelse
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Batas Waktu (Deadline)</label>
                        <input type="date" name="deadline" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Metode Penawaran</label>
                        <select name="method" class="form-control" required>
                            <option value="open">Terbuka (Open Tender)</option>
                            <option value="limited">Terbatas (Limited)</option>
                        </select>
                    </div>

                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Publikasikan RFQ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection