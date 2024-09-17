<ul class="navbar-nav sidebar sidebar-dark accordion h-100" id="accordionSidebar" style="background-color:#567DE2">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
        <div class="sidebar-brand-icon">
            <img src="<?php echo base_url('assets/img/CJT.svg'); ?>" alt="Car Icon" style="transform: scale(2); height: 24px;">
        </div>
        <div class="sidebar-brand-text mx-4">CARLJO</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Driver's Menu
    </div>

    <li class="nav-item">
        <a class="nav-link" href="<?= site_url('Menu/Trip_dashboard') ?>">
            <i class="fas fa-car-side"></i>
            <span>Trip Dashboard</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="<?= site_url('Menu/Ticket_history') ?>">
            <i class="fas fa-history"></i>
            <span>Ticket History</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="<?= site_url('Menu/Leave') ?>">
            <i class="fas fa-sticky-note"></i>
            <span>Leave</span></a>
    </li>

    <?php if ($this->session->userdata('Admin_validation') == 1): ?>
        <!-- Heading -->
        <div class="sidebar-heading mt-4">
            Admin's Menu
        </div>
        
        <li class="nav-item">
            <a class="nav-link" href="<?= site_url('Menu/Trip_Status') ?>">
                <i class="fas fa-th-list"></i>
                <span>Trip Status</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="<?= site_url('Menu/Trip_Ticket') ?>">
                <i class="fas fa-calendar-plus"></i>
                <span>Trip ticket</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="<?= site_url('Menu/Drivers_profile') ?>">
                <i class="fas fa-fw fa-id-card"></i>
                <span>Employee's Profile</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="<?= site_url('Menu/Payroll') ?>">
                <i class="fas fa-receipt"></i>
                <span>Payroll</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="<?= site_url('Menu/Leave') ?>">
                <i class="fas fa-sticky-note"></i>
                <span>Leave Request</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="<?= site_url('Menu/Leave') ?>">
            <i class="fas fa-tools"></i>
                <span>Maintenance</span></a>
        </li>
    <?php endif; ?>

    <div class="flex-fill"></div>
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
