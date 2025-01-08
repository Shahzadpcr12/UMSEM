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
            </div>
            <div class="info">
                <a href="#" class="d-block">Alexander Pierce</a>
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
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->



                <li class="nav-item">
                    <a href="<?= base_url('Role') ?>" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>
                            Roles
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('Departments') ?>" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>
                            Departments
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('Users') ?>" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>
                            Users
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('Employees') ?>" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>
                            Employees
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('Tasks') ?>" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>
                            Tasks
                        </p>
                    </a>
                </li> <li class="nav-item">
                    <a href="<?= base_url('Permissions') ?>" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>
                        Permissions
                        </p>
                    </a>
                </li>
                </li> <li class="nav-item">
                    <a href="<?= base_url('ActivityLogs') ?>" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>
                        Activity Logs
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>