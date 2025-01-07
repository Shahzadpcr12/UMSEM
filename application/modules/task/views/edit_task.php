<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Update section</h1>
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
                            <h3 class="card-title">Update Task</h3>
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
                        <form action="<?php echo base_url().'Task/update_task'; ?>" method="POST">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="hidden" name="id" value="<?php echo $task->id; ?>">

                                        <div class="form-group">
                                            <label for="role">Title</label>
                                            <input type="text" name="title" class="form-control"
                                                value="<?php echo $task->title; ?>">
                                        </div>
                                    </div>

                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label>Departments</label>
                                            <select class="form-control select2" name="department_id"
                                                style="width: 100%;">
                                                <option disabled>Select Department</option>
                                                <?php foreach ($all_dep as $dep): ?>
                                                <option value="<?php echo $dep->id; ?>"
                                                    <?php echo ($task->department_id == $dep->id) ? 'selected' : ''; ?>>
                                                    <?php echo $dep->dep_name; ?>
                                                </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                    </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>All Users</label>
                                                <select class="form-control select2" name="to_assigned"
                                                    style="width: 100%;">
                                                    <option disabled>Select Users</option>
                                                    <?php foreach ($all_users as $dep): ?>
                                                    <option value="<?php echo $dep->employee_id; ?>"
                                                        <?php echo ($task->to_assigned == $dep->employee_id) ? 'selected' : ''; ?>>
                                                        <?php echo $dep->username; ?>
                                                    </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Priority</label>
                                                <select class="form-control select2" name="priority"
                                                    style="width: 100%;" required>
                                                    <option selected="selected" disabled>Change Priority</option>
                                                    <option value="Low"
                                                        <?php echo ($task->priority == 'Low') ? 'selected' : ''; ?>>Low
                                                    </option>
                                                    <option value="Medium"
                                                        <?php echo ($task->priority == 'Medium') ? 'selected' : ''; ?>>
                                                        Medium</option>
                                                    <option value="High"
                                                        <?php echo ($task->priority == 'High') ? 'selected' : ''; ?>>
                                                        High</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">


                                            <div class="form-group">
                                                <label>Status</label>
                                                <select class="form-control select2" name="status" style="width: 100%;"
                                                    required>
                                                    <option selected="selected" disabled>Select
                                                        Status</option>
                                                    <option value="Pending"
                                                        <?php echo ($task->status == 'Pending') ? 'selected' : ''; ?>>
                                                        Pending</option>
                                                    <option value="In Progress"
                                                        <?php echo ($task->status == 'In Progress') ? 'selected' : ''; ?>>
                                                        In Progress</option>
                                                    <option value="Completed"
                                                        <?php echo ($task->status == 'Completed') ? 'selected' : ''; ?>>
                                                        Completed</option>
                                                    <option value="Overdue"
                                                        <?php echo ($task->status == 'Overdue') ? 'selected' : ''; ?>>
                                                        Overdue</option>
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



            </div>


        </div>
    </section>

</div><!-- Bootstrap CSS -->


<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script>
new DataTable('#example1');
</script>