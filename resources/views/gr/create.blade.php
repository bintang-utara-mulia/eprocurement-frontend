@extends('layouts.app')

@section('title', 'Penerimaan Barang (GR)')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Catat Penerimaan Barang (GR)</h1>
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
                <h4>Form Goods Receive (Gudang)</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('gr.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="po_id">Pilih PO Resmi (Terotorisasi)</label>
                            <select id="po_id" name="po_id" class="form-control @error('po_id') is-invalid @enderror" required>
                                <option value="">-- Pilih PO --</option>
                                @foreach($pos as $po)
                                    <option value="{{ $po->id }}" {{ old('po_id') == $po->id ? 'selected' : '' }}>
                                        {{ $po->number }} - {{ $po->vendor->name ?? '-' }}
                                        (Rp {{ number_format($po->total, 0, ',', '.') }})
                                    </option>
                                @endforeach
                            </select>
                            @if($pos->isEmpty())
                                <small class="text-muted">Belum ada PO yang terotorisasi.</small>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label for="delivery_note">Nomor Surat Jalan Vendor</label>
                            <input type="text" id="delivery_note" name="delivery_note"
                                   class="form-control @error('delivery_note') is-invalid @enderror"
                                   value="{{ old('delivery_note') }}" placeholder="Contoh: SJ-MG-2026-99" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="quantity">Jumlah Barang Diterima (Qty)</label>
                            <input type="number" id="quantity" name="quantity" min="1"
                                   class="form-control @error('quantity') is-invalid @enderror"
                                   value="{{ old('quantity', 1) }}" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="condition">Kondisi Fisik Barang</label>
                            <select id="condition" name="condition" class="form-control @error('condition') is-invalid @enderror" required>
                                <option value="good" {{ old('condition') === 'good' ? 'selected' : '' }}>Baik & Sesuai Spesifikasi</option>
                                <option value="damaged" {{ old('condition') === 'damaged' ? 'selected' : '' }}>Rusak / Tidak Sesuai</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="notes">Catatan Pemeriksaan Fisik</label>
                        <textarea id="notes" name="notes" class="form-control" rows="3"
                                  placeholder="Pemeriksaan fisik barang oleh tim gudang...">{{ old('notes') }}</textarea>
                    </div>

                    <div class="text-right">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-boxes"></i> Simpan GR (Verified)
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection