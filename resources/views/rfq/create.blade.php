@extends('layouts.app')

@section('title', 'Buat & Publikasi RFQ')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Buat & Publikasi RFQ</h1>
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
                <h4>Daftar PR Terbuka (Siap Buat RFQ)</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No. PR</th>
                                <th>Deskripsi Pengadaan</th>
                                <th>Departemen</th>
                                <th>Total Estimasi</th>
                                <th>Rekomendasi AI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($prs as $item)
                                <tr>
                                    <td><strong>{{ $item->number }}</strong></td>
                                    <td>{{ $item->description }}</td>
                                    <td>{{ $item->department }}</td>
                                    <td>Rp {{ number_format($item->estimated_total, 0, ',', '.') }}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-sm btn-ai" data-id="{{ $item->id }}">
                                            <i class="fas fa-robot mr-1"></i> Cari Vendor via AI
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">Belum ada PR yang disetujui untuk dijadikan RFQ.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal Rekomendasi AI -->
<div class="modal fade" id="aiModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="{{ route('rfq.ai_store') }}" method="POST">
            @csrf
            <input type="hidden" name="pr_id" id="modal_pr_id">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title"><i class="fas fa-magic mr-2"></i>AI Vendor Recommendation Agent</h5>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-light border">
                        <strong>Kebutuhan Pengadaan:</strong> <span id="modal_pr_desc">-</span>
                    </div>

                    <div class="form-group">
                        <label>Batas Waktu Penawaran (Deadline RFQ)</label>
                        <input type="date" name="deadline" class="form-control" value="{{ date('Y-m-d', strtotime('+7 days')) }}" required>
                    </div>

                    <label class="font-weight-bold">Daftar Vendor Hasil Analisis AI:</label>
                    <div id="vendor_list" class="list-group mb-3">
                        <!-- Diisi via AJAX JavaScript -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success"><i class="fas fa-paper-plane mr-1"></i> Kirim RFQ Kolektif</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Muat jQuery hanya jika belum dimuat oleh layouts.app --}}
<script>
    window.jQuery || document.write('<script src="https://code.jquery.com/jquery-3.6.0.min.js"><\/script>');
</script>
<script>
$(document).ready(function () {
    $('.btn-ai').on('click', function () {
        let prId = $(this).data('id');
        $('#modal_pr_id').val(prId);
        $('#modal_pr_desc').text('-');
        $('#vendor_list').html(
            '<div class="text-center py-4">' +
                '<i class="fas fa-spinner fa-spin fa-2x"></i>' +
                '<p class="mt-2">AI sedang menganalisis database vendor...</p>' +
            '</div>'
        );
        // Pindahkan modal ke <body> agar tidak tertutup backdrop
        $('#aiModal').appendTo('body').modal('show');

        $.get('/pr/' + prId + '/ai-recommend', function (data) {
            $('#modal_pr_desc').text(data.pr.description);
            let html = '';

            if (data.vendors && data.vendors.length > 0) {
                data.vendors.forEach(function (v) {
                    html += `
                        <label class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <input type="checkbox" name="vendor_ids[]" value="${v.id}" checked>
                                <strong class="ml-2">${v.name}</strong> (${v.email})
                                <br><small class="text-muted ml-4">Bidang/Kategori: ${v.department ?? 'Vendor Umum'}</small>
                            </div>
                            <span class="badge badge-success badge-pill"><i class="fas fa-check-circle mr-1"></i>Relevan</span>
                        </label>
                    `;
                });
            } else {
                html = '<div class="alert alert-warning">Tidak ada vendor yang ditemukan.</div>';
            }

            $('#vendor_list').html(html);
        }).fail(function () {
            $('#vendor_list').html(
                '<div class="alert alert-danger">Gagal mengambil rekomendasi vendor. Silakan coba lagi.</div>'
            );
        });
    });
});
</script>
@endsection