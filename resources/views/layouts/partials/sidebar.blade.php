@php
    // Options testing role: 'user_internal', 'supervisor', 'management', 'procurement', 'pejabat_keuangan', 'vendor', 'petugas_gudang', 'unit_keuangan', 'admin'
    $userRole = auth()->user()->position->name ?? 'admin'; 
@endphp

<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('dashboard') }}">E-PROCUREMENT</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('dashboard') }}">EP</a>
        </div>

        <ul class="sidebar-menu">
            <!-- Dashboard Utama -->
            <li class="menu-header">Dashboard</li>
            <li class="{{ request()->is('/') || request()->is('dashboard*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('dashboard') }}"><i class="fas fa-fire"></i> <span>Dashboard</span></a>
            </li>

            {{-- 1. USER INTERNAL: Draft PR --}}
            @if(in_array($userRole, ['admin', 'user_internal']))
                <li class="menu-header">Pengajuan PR</li>
                <li class="{{ request()->is('pr/create*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('pr.create') }}"><i class="fas fa-plus-circle"></i> <span>Buat Draft PR</span></a>
                </li>
            @endif

            {{-- 2. SUPERVISOR & MANAGEMENT: Approval PR Level 1 & Level 2 --}}
            @if(in_array($userRole, ['admin', 'supervisor', 'management']))
                <li class="menu-header">Persetujuan PR</li>
                @if(in_array($userRole, ['admin', 'supervisor']))
                    <li class="{{ request()->is('pr/approval-l1*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('pr.approval11') }}"><i class="fas fa-check"></i> <span>Approval Level 1 (<=50JT)</span></a>
                    </li>
                @endif
                @if(in_array($userRole, ['admin', 'management']))
                    <li class="{{ request()->is('pr/approval-l2*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('pr.approval12') }}"><i class="fas fa-check-double"></i> <span>Approval Level 2 (>50JT)</span></a>
                    </li>
                @endif
            @endif

            {{-- 3. PROCUREMENT STAFF: RFQ, Evaluasi, & Draft PO --}}
            @if(in_array($userRole, ['admin', 'procurement']))
                <li class="menu-header">Procurement Staff</li>
                <li class="{{ request()->is('rfq*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('rfq.create') }}"><i class="fas fa-bullhorn"></i> <span>Buat & Publikasi RFQ</span></a>
                </li>
                <li class="{{ request()->is('evaluasi*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('evaluasi.index') }}"><i class="fas fa-award"></i> <span>Evaluasi & Pemenang</span></a>
                </li>
                <li class="{{ request()->is('po/create*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('po.create') }}"><i class="fas fa-file-contract"></i> <span>Draft PO</span></a>
                </li>
            @endif

            {{-- 4. PEJABAT KEUANGAN: Otorisasi PO --}}
            @if(in_array($userRole, ['admin', 'pejabat_keuangan']))
                <li class="menu-header">Otorisasi PO</li>
                <li class="{{ request()->is('po/approve*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('po.approve') }}"><i class="fas fa-stamp"></i> <span>Otorisasi PO</span></a>
                </li>
            @endif

            {{-- 5. VENDOR (EXTERNAL): Penawaran & Kirim Invoice --}}
            @if(in_array($userRole, ['admin', 'vendor']))
                <li class="menu-header">Area Vendor</li>
                <li class="{{ request()->is('vendor/quotation*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('vendor.quotation.upload') }}"><i class="fas fa-upload"></i> <span>Unggah Penawaran</span></a>
                </li>
                <li class="{{ request()->is('vendor/invoice*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('vendor.invoice.send') }}"><i class="fas fa-paper-plane"></i> <span>Kirim Invoice</span></a>
                </li>
            @endif

            {{-- 6. PETUGAS GUDANG: Penerimaan Barang (GR) --}}
            @if(in_array($userRole, ['admin', 'petugas_gudang']))
                <li class="menu-header">Logistik & Gudang</li>
                <li class="{{ request()->is('gr/create*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('gr.create') }}"><i class="fas fa-boxes"></i> <span>Catat GR (Penerimaan)</span></a>
                </li>
            @endif

            {{-- 7. UNIT KEUANGAN: Verifikasi 3-Way Matching --}}
            @if(in_array($userRole, ['admin', 'unit_keuangan']))
                <li class="menu-header">Keuangan</li>
                <li class="{{ request()->is('invoice/verify*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('invoice.verify') }}"><i class="fas fa-calculator"></i> <span>Verifikasi 3-Way Match</span></a>
                </li>
            @endif

            {{-- MASTER DATA & SISTEM (Sesuai Tabel ERD) --}}
            @if($userRole === 'admin')
                <li class="menu-header">Master Data</li>
                <li class="{{ request()->is('items*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('items.index') }}"><i class="fas fa-box"></i> <span>Data Items</span></a>
                </li>
                <li class="{{ request()->is('departments*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('departments.index') }}"><i class="fas fa-building"></i> <span>Data Departemen</span></a>
                </li>
                <li class="{{ request()->is('users*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('users.index') }}"><i class="fas fa-users-cog"></i> <span>User & Hak Akses</span></a>
                </li>
            @endif
        </ul>
    </aside>
</div>