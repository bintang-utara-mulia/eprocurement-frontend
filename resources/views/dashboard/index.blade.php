@extends('layouts.app')

@section('title', 'Dashboard E-Procurement')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Dashboard E-Procurement</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <!-- Total PR -->
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1 shadow-sm">
                    <div class="card-icon bg-primary">
                        <i class="far fa-file"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total PR</h4>
                        </div>
                        <div class="card-body">
                            {{ $counts['pr'] ?? 0 }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total RFQ -->
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1 shadow-sm">
                    <div class="card-icon bg-danger">
                        <i class="far fa-newspaper"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total RFQ</h4>
                        </div>
                        <div class="card-body">
                            {{ $counts['rfq'] ?? 0 }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total PO -->
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1 shadow-sm">
                    <div class="card-icon bg-warning">
                        <i class="far fa-file-alt"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total PO</h4>
                        </div>
                        <div class="card-body">
                            {{ $counts['po'] ?? 0 }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Invoice -->
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1 shadow-sm">
                    <div class="card-icon bg-success">
                        <i class="fas fa-file-invoice-dollar"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Invoice</h4>
                        </div>
                        <div class="card-body">
                            {{ $counts['invoice'] ?? 0 }}
                        </div>
                    </div>
                </div>
            </div>                  
        </div>
    </div>
</section>
@endsection