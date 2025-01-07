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
                            <form action="<?php echo base_url().'Task/add_task'; ?>" method="POST">
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
                                                <label>Departments</label>
                                                <select class="form-control select2" name="department_id"
                                                    id="department_id" style="width: 100%;" required>
                                                    <option selected="selected" disabled>Select Department</option>
                                                    <?php foreach ($all_dep as $dep): ?>
                                                    <option value="<?php echo $dep->id; ?>">
                                                        <?php echo $dep->dep_name; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Assigned To</label>
                                                <select class="form-control select2" id="assigned_to" name="to_assigned"
                                                    style="width: 100%;" required>
                                                    <option selected="selected" disabled>Select User</option>
                                                    <?php foreach ($all_employees as $employees): ?>
                                                    <option value="<?php echo $employees->id; ?>">
                                                        <?php echo $employees->username; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Priority</label>
                                                <select class="form-control select2" name="priority" id="priority"
                                                    style="width: 100%;" required>
                                                    <option selected="selected" disabled>Select Priority</option>
                                                    <option value="Low">Low</option>
                                                    <option value="Medium">Medium</option>
                                                    <option value="High">High</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Status</label>
                                                <select class="form-control select2" name="status" id="status"
                                                    style="width: 100%;" required>
                                                    <option selected="selected" disabled>Select Status</option>
                                                    <option value="Pending">Pending</option>
                                                    <option value="In Progress">In Progress</option>
                                                    <option value="Completed">Completed</option>
                                                    <option value="Overdue">Overdue</option>
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

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">All Tasks</h3>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <form action="<?php echo base_url('Task/bulk_action'); ?>" method="POST">
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
                                            <a class="btn btn-primary btn-sm" href="<?php echo base_url('Task/edit_task/'.$tasks->id); ?>">
    Update
</a>


                                                
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
                                        Delete</button> 
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
    let isClearingSelection = false;

    $('#department_id').on('change', function() {
        if (!isClearingSelection) {
            isClearingSelection = true;
            $('#assigned_to').val('').trigger('change');
            $('#assigned_to').prop('disabled', true);
            isClearingSelection = false;
        }
    });

    $('#assigned_to').on('change', function() {
        if (!isClearingSelection) {
            isClearingSelection = true;
            $('#department_id').val('').trigger('change');
            $('#department_id').prop('disabled', true);
            isClearingSelection = false;
        }
    });
});
</script>
<script>
$('#select-all').click(function() {
    $('.task-checkbox').prop('checked', this.checked);
});

$('.task-checkbox').change(function() {
    if ($('.task-checkbox:checked').length == $('.task-checkbox').length) {
        $('#select-all').prop('checked', true);
    } else {
        $('#select-all').prop('checked', false);
    }
});



$('#select-all').on('change', function() {
    var isChecked = $(this).prop('checked');
    $('.task-checkbox').prop('checked', isChecked);
});
</script>