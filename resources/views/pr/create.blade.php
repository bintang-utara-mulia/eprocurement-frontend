@extends('layouts.app')

@section('title', 'Buat Draft PR')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Buat Draft Purchase Requisition (PR)</h1>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Form Pengajuan PR</h4>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form action="{{ route('pr.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Deskripsi Kebutuhan Barang / Jasa</label>
                        <input type="text" name="description" class="form-control" placeholder="Contoh: Pengadaan Laptop Kantor" required>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-4">
                            <label>Jumlah (Quantity)</label>
                            <input type="number" name="quantity" class="form-control" value="1" min="1" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Satuan (Unit)</label>
                            <input type="text" name="unit" class="form-control" placeholder="Contoh: Unit / Pcs / Paket" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Departemen</label>
                            <input type="text" name="department" class="form-control" value="{{ auth()->user()->department ?? 'IT & Software' }}" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Estimasi Total Biaya (Rp)</label>
                        <input type="number" name="estimated_total" class="form-control" placeholder="Contoh: 15000000" required>
                    </div>

                    <div class="form-group">
                        <label>Catatan Tambahan</label>
                        <textarea name="notes" class="form-control" rows="3"></textarea>
                    </div>

                    <div class="text-right">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan Draft PR</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection