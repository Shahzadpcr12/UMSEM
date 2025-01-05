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

                        <div id="taskFormContainer" style="display:none;">
                            <form action="<?php echo base_url().'Admin/add_roles'; ?>" method="POST">
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
                                                <label for="title">Title</label>
                                                <textarea class="form-control" name="title" id="title"
                                                    placeholder="Enter Title" required></textarea>
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
            $(this).text('Open'); // Change button text to 'Open'
        } else {
            formContainer.show();
            $(this).text('Close'); // Change button text to 'Close'
        }
    });
});
</script>