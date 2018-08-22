<div class="row">
    <?php echo $this->breadcrumbs->show(); ?>
    <div class="list-group">
        <a href="<?php echo site_url('demand_location/listAll'); ?>" class="list-group-item">
            <h4 class="list-group-item-heading">Demand Location View</h4>
            <p class="list-group-item-text">Enter the demand locations, budget.</p>
        </a>
    </div>

    <div class="list-group">
        <a href="<?php echo site_url('demand_location/createInitialValues'); ?>" class="list-group-item">
            <h4 class="list-group-item-heading">Initialise Demand Locations</h4>
        </a>
    </div>

</div>
<div class="row">
    <?php echo $this->session->flashdata('msg'); ?>

    <table id="emp_table" class="table table-striped table-hover">
        <caption><h4>
                <a href="<?php echo base_url(); ?>index.php/demand_location" class="btn btn-lg btn-primary"
                   style="float: right;">Add Demand Location</a>
            </h4></caption>
        <thead>
        <tr>
            <th>Name</th>
            <th>Longitude Coordinate</th>
            <th>Latitude Coordinate</th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($demand_location_list as $item): ?>
            <tr>
                <td><?php echo $item->demand_location_name; ?></td>
                <td><?php echo $item->demand_longitude_coordinate; ?></td>
                <td><?php echo $item->demand_latitude_coordinate; ?></td>
                <td><?php echo $item->penalty_unfulfilled_demand; ?></td>
                <td><?php echo $item->location_budget; ?></td>
                <td>
                    <a href="<?php echo base_url(); ?>index.php/demand_location/update/<?php echo $item->demand_location_id; ?> "
                       class="btn-sm btn-success">Edit</a>
                </td>
                <td>
                    <a href="javascript: delete_demand_location(<?php echo $item->demand_location_id; ?>)" class="btn-sm btn-danger">Delete</a>
                </td>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
