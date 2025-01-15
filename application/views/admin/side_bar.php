<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= base_url('Dashboard') ?>" class="brand-link">
        <img src="<?= base_url('admin/') ?>dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">UMSEM</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= base_url('admin/') ?>dist/img/user2-160x160.jpg" class="img-circle elevation-2"
                    alt="User Image">
            </div><h3><?php
        $user_id = $this->session->userdata('user_id');

                $userna = get_query_data("SELECT * FROM employees where id = $user_id");
              
                
          ?>
            <div class="info">
                <a href="#" class="d-block"><?php echo $userna[0]->username ?></a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <?php
        $currentSegment = $this->uri->segment(1); 
        ?>
<li class="nav-item">
            <a href="<?= base_url('Dashboard') ?>" class="nav-link <?= ($currentSegment === 'Dashboard') ? 'active' : '' ?>">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= base_url('Role') ?>" class="nav-link <?= ($currentSegment === 'Role') ? 'active' : '' ?>">
                <i class="nav-icon fas fa-tags"></i>
                <p>Roles</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= base_url('Departments') ?>" class="nav-link <?= ($currentSegment === 'Departments') ? 'active' : '' ?>">
                <i class="nav-icon far fa-building"></i>
                <p>Departments</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= base_url('Users') ?>" class="nav-link <?= ($currentSegment === 'Users') ? 'active' : '' ?>">
                <i class="nav-icon fas fa-users"></i>
                <p>Users</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= base_url('Employees') ?>" class="nav-link <?= ($currentSegment === 'Employees') ? 'active' : '' ?>">
                <i class="nav-icon fas fa-chalkboard-teacher"></i>
                <p>Employees</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= base_url('Tasks') ?>" class="nav-link <?= ($currentSegment === 'Tasks') ? 'active' : '' ?>">
                <i class="nav-icon fas fa-tasks"></i>
                <p>Tasks</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= base_url('Permissions') ?>" class="nav-link <?= ($currentSegment === 'Permissions') ? 'active' : '' ?>">
                <i class="nav-icon fas fa-key"></i>
                <p>Permissions</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= base_url('ActivityLogs') ?>" class="nav-link <?= ($currentSegment === 'ActivityLogs') ? 'active' : '' ?>">
                <i class="nav-icon far fa-file-alt"></i>
                <p>Activity Logs</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= base_url('ProfileUpdate') ?>" class="nav-link <?= ($currentSegment === 'ProfileUpdate') ? 'active' : '' ?>">
                <i class="nav-icon fas fa-user-cog"></i>
                <p>Profile</p>
            </a>
        </li>
    </ul>
</nav>

        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>