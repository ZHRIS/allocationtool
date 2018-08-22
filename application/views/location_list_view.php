<div class="row">
    <?php echo $this->breadcrumbs->show(); ?>
    <div class="list-group">
        <a href="<?php echo site_url('location/listAll'); ?>" class="list-group-item">
            <h4 class="list-group-item-heading">Study Location</h4>
            <p class="list-group-item-text">Enter the different workers' study locations to compute distances to assigned work locations.</p>
        </a>
    </div>
</div>
<div class="row">
    <?php echo $this->session->flashdata('msg'); ?>

    <table id="emp_table" class="table table-striped table-hover">        
        <caption><h4>
                <a href="<?php echo base_url(); ?>index.php/location" class="btn btn-lg btn-primary" style="float: right;">Add Study Location</a>
            </h4></caption>
        <thead>
            <tr>
                <th>Name</th>
                <th>Longitude Coordinate</th>
                <th>Latitude Coordinate</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($location_list as $item): ?>
                <tr>
                    <td><?php echo $item->location_name; ?></td>
                    <td><?php echo $item->longitude_coordinate; ?></td>
                    <td><?php echo $item->latitude_coordinate; ?></td>
                    <td>                        
                        <a href="<?php echo base_url(); ?>index.php/location/update/<?php echo $item->location_id; ?> " class="btn-sm btn-success">Edit</a>
                    </td> 
                    <td>                        
                        <a href="javascript: delete_location(<?php echo $item->location_id; ?>)" class="btn-sm btn-danger">Delete</a></td>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>



