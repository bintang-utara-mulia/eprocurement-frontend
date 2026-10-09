@extends('layouts.app')

@section('title', 'Dashboard E-Procurement')

@section('content')
@php
    $draftCount = \App\Models\PurchaseRequisition::where('status', 'draft')->count();
    $pendingCount = \App\Models\PurchaseRequisition::whereIn('status', ['pending_l1', 'pending_l2'])->count();
    $approvedCount = \App\Models\PurchaseRequisition::where('status', 'approved')->count();
    $activeRfqCount = \App\Models\Rfq::where('status', 'published')->whereDate('deadline', '>=', now())->count();
@endphp

<style>
    .ep-stat-card {
        display: flex;
        flex-direction: column;
        height: 100%;
        background: #FFFFFF;
        border: 1px solid #0F1F3D;
        border-radius: 12px;
        padding: 16px 18px 14px;
        min-height: 140px;
        box-shadow: 0 3px 8px rgba(15, 31, 61, 0.12);
        color: #0F1F3D;
        text-decoration: none;
        transition: transform .15s ease, box-shadow .15s ease;
    }
    .ep-stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 14px rgba(15, 31, 61, 0.18);
        color: #0F1F3D;
        text-decoration: none;
    }
    .ep-stat-card.ep-soft {
        border-color: #A9B6D3;
    }
    .ep-stat-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .ep-stat-title {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 14px;
        font-weight: 700;
        white-space: nowrap;
    }
    .ep-stat-icon {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
    }
    .ep-icon-draft { background: #EEF1F8; color: #5B6B8C; }
    .ep-icon-pending { background: #FFF1E3; color: #D9822B; }
    .ep-icon-approved { background: #E3F8EE; color: #1F9D63; }
    .ep-icon-rfq { background: #ECEBFF; color: #5B5FD6; }
    .ep-stat-arrow { font-size: 13px; }
    .ep-stat-number {
        font-size: 30px;
        font-weight: 800;
        line-height: 1;
        margin-top: auto;
        padding-top: 22px;
    }
    .ep-stat-caption {
        font-size: 12px;
        font-weight: 600;
        margin-top: 6px;
    }
    .ep-soft .ep-stat-title,
    .ep-soft .ep-stat-caption { color: #5B6B8C; }
</style>

<div class="section-header">
    <h1>Dashboard E-Procurement</h1>
</div>

<div class="section-body">
    <div class="row">
        <div class="col-lg-3 col-md-6 mb-4">
            <a href="{{ route('pr.create') }}" class="ep-stat-card ep-soft">
                <div class="ep-stat-top">
                    <div class="ep-stat-title">
                        <span class="ep-stat-icon ep-icon-draft"><i class="fas fa-clipboard-list"></i></span>
                        Draft PR
                    </div>
                    <i class="fas fa-arrow-right ep-stat-arrow"></i>
                </div>
                <div class="ep-stat-number">{{ $draftCount }}</div>
                <div class="ep-stat-caption">Pengajuan belum selesai</div>
            </a>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <a href="{{ route('pr.approval-l1') }}" class="ep-stat-card">
                <div class="ep-stat-top">
                    <div class="ep-stat-title">
                        <span class="ep-stat-icon ep-icon-pending"><i class="fas fa-hourglass-half"></i></span>
                        Pending Approval
                    </div>
                    <i class="fas fa-arrow-right ep-stat-arrow"></i>
                </div>
                <div class="ep-stat-number">{{ $pendingCount }}</div>
                <div class="ep-stat-caption">Menunggu persetujuan</div>
            </a>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <a href="{{ route('rfq.create') }}" class="ep-stat-card">
                <div class="ep-stat-top">
                    <div class="ep-stat-title">
                        <span class="ep-stat-icon ep-icon-approved"><i class="fas fa-check"></i></span>
                        Approved PR
                    </div>
                    <i class="fas fa-arrow-right ep-stat-arrow"></i>
                </div>
                <div class="ep-stat-number">{{ $approvedCount }}</div>
                <div class="ep-stat-caption">PR telah disetujui</div>
            </a>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <a href="{{ route('evaluasi.index') }}" class="ep-stat-card">
                <div class="ep-stat-top">
                    <div class="ep-stat-title">
                        <span class="ep-stat-icon ep-icon-rfq"><i class="fas fa-bullhorn"></i></span>
                        Active RFQ
                    </div>
                    <i class="fas fa-arrow-right ep-stat-arrow"></i>
                </div>
                <div class="ep-stat-number">{{ $activeRfqCount }}</div>
                <div class="ep-stat-caption">RFQ sedang berjalan</div>
            </a>
        </div>
    </div>
</div>
@endsection