@extends('layouts.app')

@section('title', 'Kirim Invoice Vendor')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Kirim Invoice Tagihan</h1>
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
                <h4>Form Pengajuan Tagihan / Invoice</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('vendor.invoice.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="po_id">Pilih PO Terkait</label>
                            <select id="po_id" name="po_id" class="form-control @error('po_id') is-invalid @enderror" required>
                                <option value="">-- Pilih PO --</option>
                                @foreach($pos as $po)
                                    <option value="{{ $po->id }}" data-total="{{ (int) $po->total }}"
                                        {{ old('po_id') == $po->id ? 'selected' : '' }}>
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
                            <label for="number">Nomor Invoice Vendor</label>
                            <input type="text" id="number" name="number"
                                   class="form-control @error('number') is-invalid @enderror"
                                   value="{{ old('number') }}" placeholder="Contoh: INV/MG/2026/091" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="amount">Nominal Tagihan (IDR)</label>
                            <input type="number" id="amount" name="amount" min="0"
                                   class="form-control @error('amount') is-invalid @enderror"
                                   value="{{ old('amount') }}" placeholder="Terisi otomatis dari total PO" required>
                            <small class="text-muted">Harus sama persis dengan total PO agar lolos verifikasi.</small>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="document">Unggah Dokumen Invoice (PDF, maks. 5 MB)</label>
                            <input type="file" id="document" name="document" accept=".pdf"
                                   class="form-control @error('document') is-invalid @enderror" required>
                        </div>
                    </div>

                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-paper-plane"></i> Kirim Tagihan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var po = document.getElementById('po_id');
    var amount = document.getElementById('amount');
    po.addEventListener('change', function () {
        var opt = po.options[po.selectedIndex];
        amount.value = opt && opt.dataset.total ? opt.dataset.total : '';
    });
});
</script>
@endsection