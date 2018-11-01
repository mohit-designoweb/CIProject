<?php
$this->load->view('admin/commons/header');
$this->load->view('admin/commons/navbar');
$this->load->view('admin/commons/sidebar');
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Location</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-2">Location List</div>
                        <div class="col-md-2 col-md-offset-8">
                            <a href="<?php echo base_url('location/addLocation'); ?>" class="btn btn-outline btn-primary">Add Location</a>
                        </div>
                    </div>
                </div>

                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Location Name</th>
                                <th>Location Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($locations)) {
                                $i = 1;
                                foreach ($locations as $location) {
                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $location['locationName']; ?></td>
                                        <td><image src="<?php echo base_url('public/uploads/location/' . $location['locationImage']); ?>" width="100px" height="100px" /></td>
                                        <td>
                                            <a href="<?php echo base_url('location/addLocation/' . $location['locationId']); ?>">Edit</a>
                                            <a href="<?php echo base_url('location/deleteLocation/' . $location['locationId']); ?>">Delete</a>
                                        </td>
                                    </tr>
                                    <?php
                                    $i++;
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->
<?php 
$this->load->view('admin/commons/scripts');
$this->load->view('admin/scripts/location/script');
$this->load->view('admin/commons/footer');
?>
