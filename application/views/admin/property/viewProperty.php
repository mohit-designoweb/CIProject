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
                                <div class="col-md-2">Property List</div>
                                <div class="col-md-2 col-md-offset-8">
                                    <a href="<?php echo base_url('Property/addProperty'); ?>" class="btn btn-outline btn-primary">Add Property</a>
                                </div>
                            </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Property Name</th>
                                        <th>Property Price</th>
                                        <th>Property Description</th>
                                        <th>Location</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(!empty($properties)){
                                        $i=1;
                                        foreach($properties as $property){
                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $property['propertyName']; ?></td>
                                        <td><?php echo $property['propertyPrice']; ?></td>
                                        <td><?php echo $property['propertyDescription']; ?></td>
                                        <td><?php foreach($locations as $location){
                                            if($location['locationId']==$property['locationId']){
                                                echo $location['locationName'];
                                            }
                                        }  ?></td>
                                        <td>
                                            <a href="<?php echo base_url('property/images/'.$property['propertyId']); ?>">Add Images</a>
                                            <a href="<?php echo base_url('property/addProperty/'.$property['propertyId']); ?>">Edit</a>
                                            <a href="<?php echo base_url('property/deleteProperty/'.$property['propertyId']); ?>" class="delete-property">Delete</a>
                                        </td>
                                    </tr>
                                    <?php 
                                    $i++;    
                                        }
                                    } ?>
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
$this->load->view('admin/scripts/property/script');
$this->load->view('admin/commons/footer');
?>
