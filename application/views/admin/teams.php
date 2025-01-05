
<div class="content-wrapper">
    
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Teams</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">General Form</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Teams</h3>
                        </div>
                   
                        <form method="POST" action="<?php echo base_url().'Admin/Teams/add_teams' ?>"
                            enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Name</label>
                                            <input type="team_name" id="team_name" name="team_name" class="form-control"
                                                placeholder="Team Name" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputFile">Image</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="image" name="image"
                                                        required>
                                                    <label class="custom-file-label" for="exampleInputFile">Choose
                                                        file</label>
                                                </div>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">Upload</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Short Description</label>
                                        <textarea class="form-control" rows="3" name="short_desc" id="short_desc"
                                            placeholder="Enter ..."></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">DataTable with default features</h3>
                </div>
                <div class="card-body">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Action</th>

                                <?php
                                            if($teamslist){
                                            foreach ($teamslist as $team){ ?>
                            <tr>
                                <td><?php echo $team->team_name ?></td>
                                <td><?php echo $team->short_desc ?></td>


                                <td>
                                    <?php if (!empty($team->image)) : ?>
                                    <img src="<?php echo base_url('uploads/' . $team->image); ?>" alt="Category Image"
                                        style="height: 100px; width: 100px;">
                                    <?php endif; ?>
                                </td>
                                <td>
                                  
                                    <button class="btn btn-block bg-gradient-danger"
                                        onclick="deleteCategory(<?php echo $team->id; ?>)">Delete<i
                                            class="bi bi-exclamation-octagon"></i></button>

                                </td>

                            </tr>
                            <?php }} ?>
                            </tr>

                        </thead>
                        <tbody>


                    </table>
                </div>
              
            </div>
         
        </div>
    </section>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

