<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Employee Adding section</h1>
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
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Add Employee</h3>
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
                        <form action="<?php echo base_url().'Employee/add_employeesdata'; ?>" method="POST">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">



                                        <div class="form-group">
                                            <label for="dep_name">User Name</label>
                                            <input type="text" class="form-control " id="username" name="username"
                                                placeholder="Enter User Name" required>


                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="dep_name">Status</label>
                                            <select class="form-control select2" name="status" id="status"
                                                style="width: 100%;" required>
                                                <option>select</option>
                                                <option value="active">Active</option>
                                                <option value="inactive">Inactive </option>

                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="dep_name">Password</label>
                                            <input type="text"
                                                class="form-control <?php echo form_error('password') ? 'is-invalid' : ''; ?>"
                                                name="password" id="password" placeholder="Enter Password "
                                                value="<?php echo set_value('password'); ?>" required>

                                            <?php if (form_error('password')): ?>
                                            <div class="invalid">
                                                <?php echo form_error('password'); ?>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="dep_name">Email</label>
                                            <input type="text"
                                                class="form-control <?php echo form_error('email') ? 'is-invalid' : ''; ?>"
                                                name="email" id="email" placeholder="Enter Email "
                                                value="<?php echo set_value('email'); ?>" required>

                                            <?php if (form_error('email')): ?>
                                            <div class="invalid">
                                                <?php echo form_error('email'); ?>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="dep_name">Designation</label>
                                            <input type="text" class="form-control " id="designation" name="designation"
                                                placeholder="Enter Designation " required>


                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="dep_name">Contact</label>
                                            <input type="number" class="form-control " id="contact_info"
                                                name="contact_info" placeholder="Enter Contact " required>


                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Departments</label>
                                            <select class="form-control select2" name="department_id" id="department_id"
                                                style="width: 100%;" required>
                                                <option selected="selected" disabled>Select Department</option>
                                                <?php foreach ($all_dep as $dep): ?>
                                                <option value="<?php echo $dep->id; ?>">
                                                    <?php echo $dep->dep_name; ?>
                                                </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Assign User</label>
                                            <select class="form-control select2" id="user_id" name="user_id"
                                                style="width: 100%;" required>
                                                <option selected="selected" disabled>Select User</option>
                                                <?php foreach ($all_users as $user): ?>
                                                <option value="<?php echo $user->id; ?>">
                                                    <?php echo $user->username; ?>
                                                </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>



                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">All Employee </h3>


                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <!-- <button id="generateReport" class="btn btn-success btn-sm">Download Report (PDF)</button> -->

                            <table id="example1" class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>
                                            Department
                                            <br>
                                            <select class="form-control form-control-sm" id="departmentFilter"
                                                name="departmentFilter" style="width: 100%;">
                                                <option value="">All Departments</option>
                                                <?php foreach ($depall as $department): ?>
                                                <option value="<?php echo $department->id; ?>">
                                                    <?php echo $department->dep_name; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </th>

                                        <th>
                                            Designation
                                            <br>
                                            <select class="form-control form-control-sm" id="designationFilter"
                                                name="designationFilter" style="width: 100%;">
                                                <option value="">All Designations</option>
                                                <?php foreach ($empall as $designation): ?>
                                                <option value="<?php echo $designation->designation; ?>">
                                                    <?php echo $designation->designation; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </th>

                                        <th>Assign user</th>



                                        <th>Created Date</th>
                                        <th>Active/Deactive</th>
                                        <th>Update</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($all_employee): ?>
                                    <?php foreach ($all_employee as $employee): ?>
                                    <tr>
                                        <td><?php echo $employee->id; ?></td>
                                        <td><?php echo $employee->name; ?></td>
                                        <td><?php echo $employee->email; ?></td>
                                        <td>
                                            <span class="badge bg-success" style="font-size: 14px; padding: 8px;">
                                                <?php echo $employee->status; ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge bg-success" style="font-size: 14px; padding: 8px;">
                                                <?php echo $employee->dep_name; ?>
                                            </span>
                                        </td>

                                        <td><?php echo $employee->designation; ?></td>
                                        <td><?php echo $employee->username; ?></td>

                                        <td><?php echo $employee->created_at; ?></td>
                                        <td>
                                            <?php if ($employee->status === 'Active'): ?>
                                            <button class="btn btn-warning btn-sm deactivate-btn"
                                                data-id="<?php echo $employee->id; ?>" data-status="Inactive">
                                                Deactivate
                                            </button>
                                            <?php else: ?>
                                            <button class="btn btn-success btn-sm activate-btn"
                                                data-id="<?php echo $employee->id; ?>" data-status="Active">
                                                Activate
                                            </button>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <button class="btn btn-primary btn-sm" data-toggle="modal"
                                                data-target="#updateRoleModal<?php echo $employee->id; ?>">
                                                Update
                                            </button>
                                            <div class="modal fade" id="updateRoleModal<?php echo $employee->id; ?>"
                                                tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Update User</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form
                                                            action="<?php echo base_url('Employee/update_employees'); ?>"
                                                            method="POST">
                                                            <div class="modal-body">
                                                                <input type="hidden" name="id"
                                                                    value="<?php echo $employee->id; ?>">
                                                                <div class="form-group">
                                                                    <label for="role">User name</label>
                                                                    <input type="text" name="username" class="form-control"
                                                                        value="<?php echo $employee->username; ?>" >
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="role">Email</label>
                                                                    <input type="email" name="email"
                                                                        class="form-control"
                                                                        value="<?php echo $employee->email; ?>"
                                                                        >
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="role">Designation</label>
                                                                    <input type="text" name="designation"
                                                                        class="form-control"
                                                                        value="<?php echo $employee->designation; ?>"
                                                                        >
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="role">Contact info</label>
                                                                    <input type="text" name="contact_info"
                                                                        class="form-control"
                                                                        value="<?php echo $employee->contact_info; ?>"
                                                                        >
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="status">Status</label>
                                                                    <select name="status" class="form-control" >
                                                                        <option value="Active"
                                                                            <?php echo $employee->status === 'Active' ? 'selected' : ''; ?>>
                                                                            Active</option>
                                                                        <option value="Inactive"
                                                                            <?php echo $employee->status === 'Inactive' ? 'selected' : ''; ?>>
                                                                            Inactive</option>
                                                                    </select>
                                                                </div>


                                                                <div class="form-group">
                                                                    <label>Departments</label>
                                                                    <select class="form-control select2"
                                                                        name="department_id" style="width: 100%;"
                                                                        >
                                                                        <option disabled>Select Department</option>
                                                                        <?php foreach ($all_dep as $dep): ?>
                                                                        <option value="<?php echo $dep->id; ?>"
                                                                            <?php echo ($employee->department_id == $dep->id) ? 'selected' : ''; ?>>
                                                                            <?php echo $dep->dep_name; ?>
                                                                        </option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>Assign User</label>
                                                                    <select class="form-control select2" name="user_id"
                                                                        style="width: 100%;" >
                                                                        <option disabled>Select user</option>
                                                                        <?php foreach ($all_users as $users): ?>
                                                                        <option value="<?php echo $users->id; ?>"
                                                                            <?php echo ($employee->user_id == $users->id) ? 'selected' : ''; ?>>
                                                                            <?php echo $users->username; ?>
                                                                        </option>
                                                                        <?php endforeach; ?>
                                                                    </select>
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
                                    </tr>
                                    <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script>
new DataTable('#example1');
</script>
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
                text: 'This action cannot be undone!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href =
                        '<?php echo base_url("Admin/delete_role/"); ?>' + roleId;
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

<script>
$(document).ready(function() {
    $('#departmentFilter, #designationFilter').on('change', function() {
        const departmentId = $('#departmentFilter').val();
        const designation = $('#designationFilter').val();

        $.ajax({
            url: '<?php echo base_url("Employee/filter_emp"); ?>',
            type: 'POST',
            data: {
                department_id: departmentId,
                role_id: designation // Send designation here
            },
            success: function(response) {
                $('#example1 tbody').html(response);
            },
            error: function() {
                alert('Error fetching data.');
            }
        });
    });
});
</script>
<script>
$(document).on('click', '.deactivate-btn, .activate-btn', function() {
    const userId = $(this).data('id');
    const newStatus = $(this).data('status');

    $.ajax({
        url: "<?php echo base_url('Employee/update_status'); ?>",
        type: "POST",
        data: {
            id: userId,
            status: newStatus
        },
        success: function(response) {

            alert('Employee status updated successfully.');
            location.reload();
        },
        error: function() {
            alert('Error updating user status.');
        }
    });
});
</script>