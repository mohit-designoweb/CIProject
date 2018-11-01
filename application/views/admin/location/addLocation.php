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
            <div id="error_msg"></div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-2">Location List</div>
                        <div class="col-md-2 col-md-offset-8">
                            <a href="<?php echo base_url('location/index'); ?>" class="btn btn-outline btn-primary">View Location</a>
                        </div>
                    </div>
                </div>

                <!-- /.panel-heading -->
                <div class="panel-body">
                    <form method="post" id="add-location" action="<?php if(!empty($location)){echo base_url('location/doEditLocation/'.$location['locationId']);}else{ echo base_url('location/doAddLocation');}  ?>" enctype="multipart/form-data">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2 col-md-offset-1">
                                    <label for="locationName">Location Name</label>
                                </div>
                                <div class="col-md-3">   
                                    <input type="text" class="form-control" name="locationName" value="<?php if(!empty($location['locationName'])){echo $location['locationName'];} ?>" id="locationName"/>   
                                </div>
                                <div class="col-md-2">
                                    <label for="locationImage">Location Image</label>
                                </div>    
                                <div class="col-md-3">    
                                    <input type="file" class="form-control" name="locationImage" id="locationImage"/>
                                    <?php if(!empty($location['locationImage'])){
                                    ?>
                                    <img src="<?php echo base_url('public/uploads/location/'.$location['locationImage']); ?>" height='100px' width="100px"/>
                                    <?php
                                    } ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2 col-md-offset-10">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>

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
