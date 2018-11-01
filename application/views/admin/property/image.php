<?php
$this->load->view('admin/commons/header');
$this->load->view('admin/commons/navbar');
$this->load->view('admin/commons/sidebar');
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Property</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-2">Add Images</div>
                        <div class="col-md-2 col-md-offset-8">
                            <a href="<?php echo base_url('property'); ?>" class="btn btn-outline btn-primary">View Property</a>
                        </div>
                    </div>
                </div>

                <!-- /.panel-heading -->
                <div class="panel-body">
                    <form method="post" id="add-image" action="<?php echo base_url('property/doUploadImage/'.$propertyId);  ?>" enctype="multipart/form-data">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2 col-md-offset-1">
                                    <label for="locationId">Image</label>
                                </div>
                                <div class="col-md-3">    
                                    <input type="file" class="form-control" name="propertyImage[]" id="propertyImage" multiple="multiple" />
                                    <span class="error"><?php if(!empty($error['propertyImage'])){echo $error['propertyImage'];} ?></span>
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
                        <div class="form-group">
                            <div class="row">
                                <?php 
                                if(!empty($images)){
                                foreach($images as $image){
                                    ?>
                                <div class="col-md-2">
                                    <img src="<?php echo base_url('public/uploads/property/'.$image['propertyImage']); ?>" height="150px" width="150px"/>
                                    <a href="<?php echo base_url('property/deleteImage/'.$image['imageId'].'/'.$propertyId); ?>" class="delete-image">Delete</a>
                                </div>
                                <?php
                                }
                            } ?>
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
$this->load->view('admin/scripts/property/script');
$this->load->view('admin/commons/footer');
?>