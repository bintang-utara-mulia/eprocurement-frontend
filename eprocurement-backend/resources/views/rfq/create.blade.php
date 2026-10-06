@extends('layouts.app')

@section('title', 'Buat & Publikasi RFQ')

@section('content')
<section class="section">
@if(session("success"))<div class="alert alert-success">{{ session("success") }}</div>@endif
@if($errors->any())<div class="alert alert-danger">{{ $errors->first() }}</div>@endif
    <div class="section-header">
        <h1>Buat & Publikasi Request For Quotation (RFQ)</h1>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Form Permintaan Penawaran (RFQ)</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('rfq.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Pilih PR Terverifikasi</label>
                            <select name="pr_id" class="form-control" required>
                                <option value="">-- Pilih PR Ter-approve --</option>@foreach($prs as $pr)<option value="{{$pr->id}}">{{$pr->number}} - {{$pr->description}} (Rp {{number_format($pr->estimated_total,0,",",".")}})</option>@endforeach
                                <option value="1">PR-2026-001 - Pengadaan Printer Kantor (Rp 12.500.000)</option>
                                <option value="2">PR-2026-002 - Pengadaan Server RACK 2U (Rp 85.000.000)</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Nomor RFQ</label>
                            <input type="text" class="form-control" value="RFQ-2026-0001" readonly>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Batas Akhir Penawaran (Deadline)</label>
                            <input type="date" name="deadline" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Metode Pengadaan</label>
                            <select name="method" class="form-control" required>
                                <option value="open">Lelang Terbuka (Public)</option>
                                <option value="limited">Lelang Terbatas (Invited Vendors)</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Ketentuan & Spesifikasi Teknis Khusus</label>
                        <textarea name="specifications" class="form-control" rows="4" placeholder="Tuliskan spesifikasi teknis barang, garansi, dan syarat pengiriman..."></textarea>
                    </div>

                    <div class="text-right">
                        <button type="reset" class="btn btn-secondary">Reset</button>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Publikasikan RFQ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection