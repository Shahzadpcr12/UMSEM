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


                        <?php if ($this->session->flashdata('invalid')): ?>
                        <div class="alert alert-danger" role="alert" id="invld">
                            <?php echo $this->session->flashdata('invalid'); ?>
                        </div>
                        <?php endif; ?>


                        <?php if ($this->session->flashdata('successfull')): ?>
                        <div class="alert alert-success" role="alert" id="unsuccess">
                            <?php echo $this->session->flashdata('successfull'); ?>
                        </div>
                        <?php endif; ?>
                        <?php if ($this->session->flashdata('existing_role_error')): ?>
                        <div class="alert alert-danger" role="alert" id="roleErrorAlert">
                            <?php echo $this->session->flashdata('existing_role_error'); ?>
                        </div>

                        <?php endif; ?>
                        <form action="<?php echo base_url().'Role/add_roles'; ?>" method="POST">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="role">Role</label>
                                    <input type="text"
                                        class="form-control <?php echo form_error('role') ? 'is-invalid' : ''; ?>"
                                        name="role" id="role" placeholder="Enter Role"
                                        value="<?php echo set_value('role'); ?>" required>

                                    <?php if (form_error('role')): ?>
                                    <div class="invalid">
                                        <?php echo form_error('role'); ?>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>


                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">All Roles</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Roles</th>
                                        <th>Delete</th>
                                        <th>Edit</th>
                                        <th>Permission</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($all_roles): ?>
                                    <?php foreach ($all_roles as $roles): ?>
                                    <tr>
                                        <td><?php echo $roles->id; ?></td>
                                        <td><?php echo $roles->role; ?></td>
                                        <td>
                                            <button class="btn btn-danger btn-sm delete-btn"
                                                data-id="<?php echo $roles->id; ?>">
                                                Delete
                                            </button>
                                        </td>
                                        <td>
                                            <button class="btn btn-primary btn-sm" data-toggle="modal"
                                                data-target="#updateRoleModal<?php echo $roles->id; ?>">
                                                Edit
                                            </button>


                                            <div class="modal fade" id="updateRoleModal<?php echo $roles->id; ?>"
                                                tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edit Role</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="<?php echo base_url('Role/update_role'); ?>"
                                                            method="POST">
                                                            <div class="modal-body">
                                                                <input type="hidden" name="id"
                                                                    value="<?php echo $roles->id; ?>">
                                                                <div class="form-group">
                                                                    <label for="role">Role Name</label>
                                                                    <input type="text" name="role" class="form-control"
                                                                        value="<?php echo $roles->role; ?>" required>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Save
                                                                    changes</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="<?php echo base_url('role/Role/manage_permissions/' . $roles->id); ?>"
                                                class="btn btn-warning btn-sm">
                                                Permission
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const deleteButtons = document.querySelectorAll('.delete-btn');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const roleId = this.getAttribute('data-id');

            Swal.fire({
                title: 'Are you sure?',
                // text: 'This action cannot be undone!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href =
                        '<?php echo base_url("Role/delete_role/"); ?>' + roleId;
                }
            });
        });
    });
});
</script>
<script>
setTimeout(function() {
    document.getElementById('roleErrorAlert').style.display = 'none';
}, 3000);
setTimeout(function() {
    document.getElementById('unsuccess').style.display = 'none';
}, 3000);
setTimeout(function() {
    document.getElementById('invld').style.display = 'none';
}, 3000);
</script>