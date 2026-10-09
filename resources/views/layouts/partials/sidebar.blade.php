<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand ep-brand">
            <a href="{{ route('dashboard') }}">
                <span class="ep-brand-logo">N</span>
                <span class="ep-brand-text">E-PROCUREMENT<br>PT NUSANTARA<br>JAYA</span>
            </a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('dashboard') }}">EP</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('dashboard') }}"><i class="fas fa-fire"></i> <span>Dashboard</span></a>
            </li>

            <li class="menu-header">Pengajuan PR</li>
            <li class="{{ request()->routeIs('pr.create') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('pr.create') }}"><i class="fas fa-plus-circle"></i> <span>Buat Draft PR</span></a>
            </li>

            <li class="menu-header">Persetujuan PR</li>
            <li class="{{ request()->routeIs('pr.approval-l1') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('pr.approval-l1') }}"><i class="fas fa-check"></i> <span>Approval Level 1 (<=50JT)</span></a>
            </li>
            <li class="{{ request()->routeIs('pr.approval-l2') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('pr.approval-l2') }}"><i class="fas fa-check-double"></i> <span>Approval Level 2 (>50JT)</span></a>
            </li>

            <li class="menu-header">Procurement Staff</li>
            <li class="{{ request()->routeIs('rfq.create') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('rfq.create') }}"><i class="fas fa-bullhorn"></i> <span>Buat & Publikasi RFQ</span></a>
            </li>
            <li class="{{ request()->routeIs('evaluasi.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('evaluasi.index') }}"><i class="fas fa-gavel"></i> <span>Evaluasi & Pemenang</span></a>
            </li>
            <li class="{{ request()->routeIs('po.create') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('po.create') }}"><i class="fas fa-file-contract"></i> <span>Draft PO</span></a>
            </li>

            <li class="menu-header">Otorisasi PO</li>
            <li class="{{ request()->routeIs('po.approve') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('po.approve') }}"><i class="fas fa-signature"></i> <span>Otorisasi PO</span></a>
            </li>

            <li class="menu-header">Portal Vendor</li>
            <li class="{{ request()->routeIs('vendor.quotation.upload') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('vendor.quotation.upload') }}"><i class="fas fa-upload"></i> <span>Unggah Penawaran</span></a>
            </li>
            <li class="{{ request()->routeIs('vendor.invoice.send') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('vendor.invoice.send') }}"><i class="fas fa-file-invoice-dollar"></i> <span>Kirim Invoice</span></a>
            </li>

            <li class="menu-header">Logistik & Gudang</li>
            <li class="{{ request()->routeIs('gr.create') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('gr.create') }}"><i class="fas fa-boxes"></i> <span>Penerimaan Barang (GR)</span></a>
            </li>

            <li class="menu-header">Keuangan</li>
            <li class="{{ request()->routeIs('invoice.verify') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('invoice.verify') }}"><i class="fas fa-receipt"></i> <span>Verifikasi Invoice</span></a>
            </li>

            <li class="menu-header">Master Data</li>
            <li class="{{ request()->routeIs('items.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('items.index') }}"><i class="fas fa-box"></i> <span>Master Barang</span></a>
            </li>
            <li class="{{ request()->routeIs('departments.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('departments.index') }}"><i class="fas fa-building"></i> <span>Master Departemen</span></a>
            </li>
            <li class="{{ request()->routeIs('users.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('users.index') }}"><i class="fas fa-users"></i> <span>Master Users</span></a>
            </li>
        </ul>
    </aside>
</div>