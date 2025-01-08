<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Activity  section</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
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
                            <h3 class="card-title">Activity section</h3>
                           
                        </div>


                  

                       
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">All Logs of Tasks</h3>
                        </div>
                        <div class="card-body table-responsive p-0">
                           
                        <table id="example1" class="table table-hover text-nowrap">
    <thead>
        <tr>
            <th>Id</th>
            <th>Task title</th>
            <th>Action by</th>
            <th>Action</th>
            <th>Create Date/Time</th>
            <th>Update Date/Time</th>
            <!-- <th>Delete</th> -->
        </tr>
    </thead>
    <tbody>
        <?php if ($all_activitylogs): ?>
            <?php foreach ($all_activitylogs as $logs): ?>
                <tr>
                    <td><?php echo $logs->id; ?></td>
                    <td><?php echo $logs->title; ?></td>
                    <td><?php echo $logs->username; ?></td>
                    <td>
                        <span class="badge bg-success" style="font-size: 14px; padding: 8px;">
                            <?php echo $logs->status; ?>
                        </span>
                    </td>
                    <td><?php echo $logs->created_date; ?></td>
                    <td><?php echo $logs->updated_date; ?></td>

                    <!-- Delete button -->
                    <!-- <td>
                    <a href="<?php //echo base_url('DeleteActivity/' . $logs->id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this activity?');">
    Delete
</a>



                    </td> -->
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
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script>
new DataTable('#example1');
</script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- <script>
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
                        '<?php //echo base_url("activity_logs/Activity/delete_activity/"); ?>' + roleId;
                }
            });
        });
    });
});
</script> -->
