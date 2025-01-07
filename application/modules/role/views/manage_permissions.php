<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Role Adding section</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">General Form</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Add Role</h3>
                        </div>


                       

                    
                        <div class="container mt-5">
        <h3>Manage Permissions for Role: <strong><?php echo $role_name; ?></strong></h3>

        <form action="<?php echo base_url('Role/update_permissions'); ?>" method="POST">
            <input type="hidden" name="role_id" value="<?php echo $role_id; ?>">

            <?php foreach ($permissions as $module => $actions): ?>
                <div class="form-group">
                    <h5><?php echo ucfirst($module); ?></h5>
                    <?php foreach ($actions as $action): ?>
                        <div class="form-check">
                            <input 
                                type="checkbox" 
                                class="form-check-input" 
                                name="permissions[]" 
                                value="<?php echo $action['id']; ?>" 
                                <?php echo in_array($action['id'], $role_permissions) ? 'checked' : ''; ?>>
                            <label class="form-check-label">
                                <?php echo ucfirst($action['action']); ?>
                            </label>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>

            <button type="submit" class="btn btn-primary">Save Permissions</button>
            <a href="<?php echo base_url('Admin/roles'); ?>" class="btn btn-secondary">Back</a>
        </form>
    </div>
                    </div>
                </div>

               
            </div>
        </div>
    </section>

</div>