@extends('layouts.app')

@section('title', 'Unggah Penawaran Vendor')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Unggah Penawaran (Quotation)</h1>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Form Pengajuan Harga & Dokumen Penawaran</h4>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible show fade">
                        <div class="alert-body">
                            <button class="close" data-dismiss="alert"><span>&times;</span></button>
                            {{ session('success') }}
                        </div>
                    </div>
                @endif

                <form action="{{ route('vendor.quotation.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Pilih RFQ Aktif</label>
                            <select name="rfq_id" class="form-control" required>
                                <option value="">-- Pilih Paket RFQ --</option>
                                @foreach($rfqs as $rfq)
                                    <option value="{{ $rfq->id }}">{{ $rfq->number }} - {{ $rfq->pr->description ?? 'Pengadaan' }} (s.d. {{ $rfq->deadline }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Nama Perusahaan / Vendor</label>
                            <input type="text" class="form-control" value="{{ auth()->user()->name }}" readonly>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Harga Penawaran (Offered Price - IDR)</label>
                            <input type="text" name="price" id="price_input" class="form-control" placeholder="Contoh: 48.500.000" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Unggah Dokumen Penawaran (PDF, maks. 5 MB)</label>
                            <input type="file" name="document" class="form-control" accept=".pdf" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Catatan Penawaran / Spesifikasi Barang</label>
                        <textarea name="notes" class="form-control" rows="3" placeholder="Tuliskan detail barang, garansi, dan lama waktu pengerjaan/pengiriman..."></textarea>
                    </div>

                    <div class="text-right">
                        <button type="reset" class="btn btn-secondary">Reset</button>
                        <button type="submit" class="btn btn-success"><i class="fas fa-paper-plane mr-1"></i> Kirim Penawaran</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#price_input').on('keyup input', function() {
        let value = $(this).val().replace(/[^0-9]/g, '');
        if (value) {
            $(this).val(new Intl.NumberFormat('id-ID').format(value));
        } else {
            $(this).val('');
        }
    });
});
</script>
@endsection