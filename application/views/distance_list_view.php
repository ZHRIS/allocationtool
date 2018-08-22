<div class="row">
    <?php echo $this->breadcrumbs->show(); ?>
    <div class="list-group">
        <a href="<?php echo site_url('distance/listAll'); ?>" class="list-group-item">
            <h4 class="list-group-item-heading">Distance Lookup Table</h4>
            <p class="list-group-item-text">Enter the road distances for the different pairs between study and demand locations. If not entered, a default is computed.</p>
        </a>
    </div>
</div>
<div class="row">
    <?php echo $this->session->flashdata('msg'); ?>
    <br/>    
    <table id="emp_table" class="table table-striped table-hover">
        <caption><h4><a href="<?php echo base_url(); ?>index.php/distance" class="btn btn-lg btn-primary" style="float: right;">Add Distance Lookup</a></h4></caption>
        <thead>
            <tr>
                <th>Demand Location</th>
                <th>Study Location</th>
                <th>Road Distance (km)</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($list as $item): ?>
                <tr>
                    <td><?php echo $item->demand_location_name; ?></td>
                    <td><?php echo $item->location_name; ?></td>
                    <td><?php echo $item->road_distance; ?></td>
                    <td>
                       <a href="<?php echo base_url(); ?>index.php/distance/update/<?php echo $item->distance_id; ?> " class="btn-sm btn-success">View</a>
                    </td>  
                    <td>
                        <a href="javascript: delete_distance(<?php echo $item->distance_id; ?>)" class="btn-sm btn-danger">Delete</a></td>
                    </td>   
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
