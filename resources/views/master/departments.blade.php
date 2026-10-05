@extends('layouts.app')

@section('title', 'Master Departments')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Data Master Department</h1>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Daftar Departemen</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 50px;">#</th>
                                <th>Nama Departemen</th>
                                <th>Kode Departemen</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($departments as $index => $dept)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $dept->name ?? $dept->department_name ?? '-' }}</td>
                                    <td>{{ $dept->code ?? $dept->department_code ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted">Belum ada data departemen di database.</td>
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