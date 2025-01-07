<div class="col-md-6">
                                            <div class="form-group">
                                                <label for="role">Select Role</label>
                                                <select id="role" name="role" class="form-control">
                                                    <option value="">Select Role</option>
                                                    <?php foreach ($roles as $role): ?>
                                                    <option value="<?php echo $role->id; ?>"><?php echo $role->role; ?>
                                                    </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>




                                        <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Task Adding section</h1>
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

    <section class="content">

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Add Task</h3>
                            <button type="button" class="btn btn-primary float-right" style="background-color: black;"
                                id="toggleFormBtn">Open</button>
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

                        <div id="taskFormContainer">
                            <!-- style="display:none;" -->
                            <form action="<?php echo base_url('Task/add_task'); ?>" method="POST">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">



                                            <div class="form-group">
                                                <label for="dep_name">Title</label>
                                                <input type="text" class="form-control " id="title" name="title"
                                                    placeholder="Enter Title" required>


                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="title">Description</label>
                                                <textarea class="form-control" name="description" id="description"
                                                    placeholder="Enter Description" required></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">


                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="department_select">Select Department</label>
                                                <select id="department_select" class="form-control">
                                                    <option value="">Select Department</option>
                                                </select>
                                            </div>


                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="employee_select">Select Employee</label>
                                                <select id="employee_select" class="form-control">
                                                </select>
                                            </div>
                                        </div>



                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Add</button>
                                    </div>
                            </form>
                        </div>
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
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
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
$(document).ready(function() {
    $('#toggleFormBtn').click(function() {
        var formContainer = $('#taskFormContainer');
        if (formContainer.is(":visible")) {
            formContainer.hide();
            $(this).text('Open');
        } else {
            formContainer.show();
            $(this).text('Close');
        }
    });
});
</script>

<script>
$(document).ready(function() {

    $.ajax({
        url: '<?php echo base_url("Task/get_departments"); ?>',
        type: 'GET',
        success: function(response) {
            const departments = JSON.parse(response);
            let options = '<option value="">Select Department</option>';
            departments.forEach(dept => {
                options += `<option value="${dept.id}">${dept.dep_name}</option>`;
            });
            $('#department_select').html(options);
        },
        error: function(xhr, status, error) {
            console.error('Error fetching departments:', error);
        }
    });


    $('#department_select').change(function() {
        const departmentId = $(this).val();
        if (departmentId) {
            $.ajax({
                url: '<?php echo base_url("Task/get_employees_by_department"); ?>',
                type: 'POST',
                data: {
                    department_id: departmentId
                },
                success: function(response) {
                    console.log('Raw Response:', response);
                    try {
                        const employees = JSON.parse(response);
                        console.log('Parsed Employees:', employees);
                        let options = '';
                        employees.forEach(emp => {
                            options +=
                                `<option value="${emp.id}">${emp.username}</option>`;
                        });
                        console.log('Options:', options);
                        $('#employee_select').html(options);
                    } catch (err) {
                        console.error('Error parsing response:', err);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', error);
                }
            });
        } else {
            $('#employee_select').html('');
        }
    });


});
</script>


<div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">All Users</h3>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table id="example1" class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Title</th>
                                        <th>Assigned To</th>
                                        <th>Status</th>
                                        <th>Priority</th>
                                        <th>Create Date</th>
                                        <th>Update</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($all_tasks): ?>
                                    <?php foreach ($all_tasks as $tasks): ?>
                                    <tr>
                                        <td><?php echo $tasks->id; ?></td>
                                        <td><?php echo $tasks->title; ?></td>
                                        <td><?php echo $tasks->username; ?></td>
                                        <td>
                                            <span class="badge bg-success" style="font-size: 14px; padding: 8px;">
                                                <?php echo $tasks->status; ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge bg-success" style="font-size: 14px; padding: 8px;">
                                                <?php echo $tasks->priority; ?>
                                            </span>
                                        </td>
                                        <td><?php echo $tasks->created_at; ?></td>
                                        <td>
                                            <button class="btn btn-primary btn-sm" data-toggle="modal"
                                                data-target="#updateRoleModal<?php echo $tasks->id; ?>">
                                                Update
                                            </button>
                                            <div class="modal fade" id="updateRoleModal<?php echo $tasks->id; ?>"
                                                tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Update Task</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="<?php echo base_url('Task/update_task'); ?>"
                                                            method="POST">
                                                            <div class="modal-body">
                                                                <input type="hidden" name="id"
                                                                    value="<?php echo $tasks->id; ?>">

                                                                <div class="form-group">
                                                                    <label for="role">Title</label>
                                                                    <input type="text" name="title" class="form-control"
                                                                        value="<?php echo $tasks->title; ?>" required>
                                                                </div>


                                                                <div class="form-group">
                                                                    <label>Departments</label>
                                                                    <select class="form-control select2"
                                                                        name="department_id" style="width: 100%;"
                                                                        required>
                                                                        <option disabled>Select Department</option>
                                                                        <?php foreach ($all_dep as $dep): ?>
                                                                        <option value="<?php echo $dep->id; ?>"
                                                                            <?php echo ($tasks->department_id == $dep->id) ? 'selected' : ''; ?>>
                                                                            <?php echo $dep->dep_name; ?>
                                                                        </option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>All Users</label>
                                                                    <select class="form-control select2"
                                                                        name="to_assigned" style="width: 100%;"
                                                                        required>
                                                                        <option disabled>Select Users</option>
                                                                        <?php foreach ($all_users as $dep): ?>
                                                                        <option value="<?php echo $dep->employee_id; ?>"
                                                                            <?php echo ($tasks->to_assigned == $dep->employee_id) ? 'selected' : ''; ?>>
                                                                            <?php echo $dep->username; ?>
                                                                        </option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>Priority</label>
                                                                    <select class="form-control select2" name="priority"
                                                                        style="width: 100%;" required>
                                                                        <option selected="selected" disabled>Change
                                                                            Priority</option>
                                                                        <option value="Low"
                                                                            <?php echo ($tasks->priority == 'Low') ? 'selected' : ''; ?>>
                                                                            Low</option>
                                                                        <option value="Medium"
                                                                            <?php echo ($tasks->priority == 'Medium') ? 'selected' : ''; ?>>
                                                                            Medium</option>
                                                                        <option value="High"
                                                                            <?php echo ($tasks->priority == 'High') ? 'selected' : ''; ?>>
                                                                            High</option>
                                                                    </select>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>Status</label>
                                                                    <select class="form-control select2" name="status"
                                                                        style="width: 100%;" required>
                                                                        <option selected="selected" disabled>Select
                                                                            Status</option>
                                                                        <option value="Pending"
                                                                            <?php echo ($tasks->status == 'Pending') ? 'selected' : ''; ?>>
                                                                            Pending</option>
                                                                        <option value="In Progress"
                                                                            <?php echo ($tasks->status == 'In Progress') ? 'selected' : ''; ?>>
                                                                            In Progress</option>
                                                                        <option value="Completed"
                                                                            <?php echo ($tasks->status == 'Completed') ? 'selected' : ''; ?>>
                                                                            Completed</option>
                                                                        <option value="Overdue"
                                                                            <?php echo ($tasks->status == 'Overdue') ? 'selected' : ''; ?>>
                                                                            Overdue</option>
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
                    </div>
                </div>


                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">All Tasks</h3>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <form action="<?php echo base_url('Task/bulk_delete'); ?>" method="POST">
                                <table id="example1" class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" id="select-all" /></th>
                                            <!-- Select All checkbox -->
                                            <th>Id</th>
                                            <th>Title</th>
                                            <th>Assigned To</th>
                                            <th>Status</th>
                                            <th>Priority</th>
                                            <th>Create Date</th>
                                            <th>Update</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if ($all_tasks): ?>
                                        <?php foreach ($all_tasks as $tasks): ?>
                                        <tr>
                                            <td><input type="checkbox" name="task_ids[]"
                                                    value="<?php echo $tasks->id; ?>" class="task-checkbox" /></td>
                                            <!-- Task selection checkbox -->
                                            <td><?php echo $tasks->id; ?></td>
                                            <td><?php echo $tasks->title; ?></td>
                                            <td><?php echo $tasks->username; ?></td>
                                            <td>
                                                <span class="badge bg-success" style="font-size: 14px; padding: 8px;">
                                                    <?php echo $tasks->status; ?>
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge bg-success" style="font-size: 14px; padding: 8px;">
                                                    <?php echo $tasks->priority; ?>
                                                </span>
                                            </td>
                                            <td><?php echo $tasks->created_at; ?></td>
                                            <td>
                                                <!-- Individual update button (modal, etc.) -->
                                                <button class="btn btn-primary btn-sm" data-toggle="modal"
                                                    data-target="#updateTaskModal<?php echo $tasks->id; ?>">Update</button>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                                <div class="form-group">
                                    <label for="bulk-status">Bulk Action</label>
                                    <select class="form-control select2" name="status" id="bulk-status" required>
                                        <option selected="selected" disabled>Select Status</option>
                                        <option value="Pending">Pending</option>
                                        <option value="In Progress">In Progress</option>
                                        <option value="Completed">Completed</option>
                                        <option value="Overdue">Overdue</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Bulk Update</button>
                                    <button type="submit" name="bulk_delete" value="delete" class="btn btn-danger">Bulk
                                        Delete</button> <!-- POST request for deletion -->
                                </div>
                            </form>

                        </div>
                    </div>
                </div>