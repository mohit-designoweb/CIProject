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
                        <div class="col-md-2">Add Property</div>
                        <div class="col-md-2 col-md-offset-8">
                            <a href="<?php echo base_url('property'); ?>" class="btn btn-outline btn-primary">View Property</a>
                        </div>
                    </div>
                </div>

                <!-- /.panel-heading -->
                <div class="panel-body">
                    <form method="post" id="add-property" action="<?php if(!empty($property)){echo base_url('property/doEditProperty/'.$property['propertyId']);}else{ echo base_url('property/doAddProperty');}  ?>">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2 col-md-offset-1">
                                    <label for="locationId">Location Name</label>
                                </div>
                                <div class="col-md-3">
                                    <?php echo form_dropdown(['name'=>'locationId','id'=>'locationId','class'=>'form-control'],$location,isset($property['locationId'])?$property['locationId']:''); ?>
                                    
                                </div>
                                <div class="col-md-2">
                                    <label for="propertyName">Property Name</label>
                                </div>
                                <div class="col-md-3">   
                                    <input type="text" class="form-control" name="propertyName" value="<?php if(!empty($property['propertyName'])){echo $property['propertyName'];} ?>" id="propertyName"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2 col-md-offset-1">
                                    <label for="propertyPrice">Property Price</label>
                                </div>
                                <div class="col-md-3">   
                                    <input type="text" class="form-control" name="propertyPrice" value="<?php if(!empty($property['propertyPrice'])){echo $property['propertyPrice'];} ?>" id="propertyPrice"/>    
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2 col-md-offset-1">
                                    <label for="propertyDescription">Property Description</label>
                                </div>
                                <div class="col-md-8">
                                    <textarea name="propertyDescription" id="propertyDescription" class="form-control" rows="5"><?php if(!empty($property['propertyDescription'])){echo $property['propertyDescription'];} ?></textarea>
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
$this->load->view('admin/scripts/property/script');
$this->load->view('admin/commons/footer');
?>