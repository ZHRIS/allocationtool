<div class="row">
    <?php echo $this->breadcrumbs->show(); ?>
</div>
<div class="row">
    <?php echo $this->session->flashdata('msg'); ?>
    <div class="row">
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Worker Details
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="row colbox">

                            <div class="col-lg-4 col-sm-4">
                                <label for="graduate_no" class="control-label">Graduate #</label>
                            </div>
                            <div class="col-lg-8 col-sm-8">
                                <?php echo $emp->graduate_no; ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row colbox">
                            <div class="col-lg-4 col-sm-4">
                                <label for="first_name" class="control-label">First Name</label>
                            </div>
                            <div class="col-lg-8 col-sm-8">
                                <?php echo $emp->first_name; ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row colbox">
                            <div class="col-lg-4 col-sm-4">
                                <label for="last_name" class="control-label">Last Name</label>
                            </div>
                            <div class="col-lg-8 col-sm-8">
                                <?php echo $emp->last_name; ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row colbox">
                            <div class="col-lg-4 col-sm-4">
                                <label for="worker_type_name" class="control-label">Worker Type</label>
                            </div>
                            <div class="col-lg-8 col-sm-8">
                                <?php echo $emp->worker_type_name; ?>

                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row colbox">
                            <div class="col-lg-4 col-sm-4">
                                <label for="worker_level_name" class="control-label">Worker Level</label>
                            </div>
                            <div class="col-lg-8 col-sm-8">
                                <?php echo $emp->worker_level_name; ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row colbox">
                            <div class="col-lg-4 col-sm-4">
                                <label for="gender" class="control-label">Gender</label>
                            </div>
                            <div class="col-lg-8 col-sm-8">
                                <?php echo $emp->gender; ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row colbox">
                            <div class="col-lg-4 col-sm-4">
                                <label for="adjusted_salary" class="control-label">Adjusted Salary</label>
                            </div>
                            <div class="col-lg-8 col-sm-8">
                                <?php echo $emp->adjusted_salary; ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row colbox">
                            <div class="col-lg-4 col-sm-4">
                                <label for="potential_fixed_location" class="control-label">Assigned to a Fixed
                                    Location</label>
                            </div>
                            <div class="col-lg-8 col-sm-8">

                                <?php
                                echo $emp->assigned_to_fixed_location
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row colbox">
                            <div class="col-lg-4 col-sm-4">
                                <label for="potential_fixed_location" class="control-label">Potential fixed
                                    location</label>
                            </div>
                            <div class="col-lg-8 col-sm-8">

                                <?php
                                if ($emp->assigned_to_fixed_location === 'YES') {
                                    $demand_location_name = $emp->demand_location_name;
                                    if (isset($demand_location_name)) {
                                        echo $demand_location_name;
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row colbox">
                            <div class="col-lg-4 col-sm-4">
                                <label for="do_not_assign_outside_preferences" class="control-label">Assign
                                    Outside of Preferences?</label>
                            </div>
                            <div class="col-lg-8 col-sm-8">
                                <?php
                                if ($emp->do_not_assign_outside_preferences === "NO") {
                                    echo "YES";
                                } else {
                                    echo "NO";
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Allocation
                </div>
                <div class="panel-body">

                    <div class="form-group">
                        <div class="row colbox">
                            <?php echo $assigned_demand_location; ?>
                        </div>
                    </div>

                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>Preference</th>
                            <th>Demand location</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($preferencelist as $i => $item): ?>
                            <tr>
                                <td><?php echo($i + 1) ?></td>
                                <td><?php echo $item->demand_location_name; ?></td>
                                <td>
                                    <a href="javascript: delete_preference(<?php echo $item->preference_id; ?>)"
                                       class="btn-sm btn-danger">Delete</a></td>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>

                </div>
            </div>

        </div>
    </div>

    <a href="<?php echo base_url(); ?>index.php/graduate/update/<?php echo $emp->graduate_id; ?> "
       class="btn btn-sm btn-success">Update Information</a>

    <?php
    if ($emp->assigned_to_fixed_location === 'YES') {
        echo '<a href=" ' . base_url() . 'index.php/graduate/remove_fixed_location/' . $emp->graduate_id . '" class="btn btn-sm btn-danger">Remove Fixed Location </a> ';
    }
    ?>

    <a href="<?php echo base_url(); ?>index.php/graduate/createPreference/<?php echo $emp->graduate_id; ?> "
       class="btn btn-sm btn-primary">Add Preference</a>

</div>

