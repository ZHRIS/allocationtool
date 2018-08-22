<div class="row">
    <?php echo $this->breadcrumbs->show(); ?>
</div>
<div class="row">
    <div class="col-sm-offset-3 col-lg-6 col-sm-6 well">
        <legend>Add Demand Location</legend>
        <?php
        $attributes = array("class" => "form-horizontal", "id" => "locationform", "name" => "locationform");
        echo form_open("demand_location/index", $attributes);
        ?>
        <fieldset>

            <div class="form-group">
                <div class="row colbox">
                    <div class="col-lg-4 col-sm-4">
                        <label for="demand_location_name" class="control-label">Location Name</label>
                    </div>
                    <div class="col-lg-8 col-sm-8">
                        <input id="demand_location_name" name="demand_location_name" placeholder="demand location name" type="text" class="form-control"  value="<?php echo set_value('demand_location_name'); ?>" />
                        <span class="text-danger"><?php echo form_error('demand_location_name'); ?></span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row colbox">
                    <div class="col-lg-4 col-sm-4">
                        <label for="demand_longitude_coordinate" class="control-label">Longitude Coordinate</label>
                    </div>
                    <div class="col-lg-8 col-sm-8">
                        <input id="demand_longitude_coordinate" name="demand_longitude_coordinate" placeholder="longitude coordinate" type="text" class="form-control"  value="<?php echo set_value('longitude_coordinate'); ?>" />
                        <span class="text-danger"><?php echo form_error('longitude_coordinate'); ?></span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row colbox">
                    <div class="col-lg-4 col-sm-4">
                        <label for="demand_latitude_coordinate" class="control-label">Latitude Coordinate</label>
                    </div>
                    <div class="col-lg-8 col-sm-8">
                        <input id="demand_latitude_coordinate" name="demand_latitude_coordinate" placeholder="latitude coordinate" type="text" class="form-control"  value="<?php echo set_value('latitude_coordinate'); ?>" />
                        <span class="text-danger"><?php echo form_error('latitude_coordinate'); ?></span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row colbox">
                    <div class="col-lg-4 col-sm-4">
                        <label for="location_budget" class="control-label">Budget
                            <label class="m"> (<?php echo $tool_currency; ?>) </label>
                        </label>
                    </div>
                    <div class="col-lg-8 col-sm-8">
                        <input id="location_budget" name="location_budget" placeholder="location budget" type="text" class="form-control"  value="<?php echo set_value('location_budget'); ?>" />
                        <span class="text-danger"><?php echo form_error('location_budget'); ?></span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row colbox">
                    <div class="col-lg-4 col-sm-4">
                        <label for="penalty_unfulfilled_demand" class="control-label">Penalty Unfulfilled Demand</label>
                    </div>
                    <div class="col-lg-8 col-sm-8">
                        <input id="penalty_unfulfilled_demand" name="penalty_unfulfilled_demand" placeholder="penalty_unfulfilled_demand" type="text" class="form-control"  value="<?php echo $this->setting_model->get_default_penalty_unfulfilled_demand(); ?>"/>
                        <span class="text-danger"><?php echo form_error('penalty_unfulfilled_demand'); ?></span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-4 col-lg-8 col-sm-8 text-left">
                    <input id="btn_add" name="btn_add" type="submit" class="btn btn-primary" value="Save" />
                  <a href="<?php echo site_url('demand_location/listAll'); ?>" class="btn btn-danger">Cancel</a>
            </div>
        </fieldset>
        <fieldset>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Worker Type</th>
                        <th>Requested Personnel</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($list as $item): ?>
                        <tr>
                            <td><?php echo $item->worker_type_name; ?></td>
                            <td>
                                <input name="<?php echo $item->worker_type_id; ?>" type="text"  value="<?php echo set_value($item->worker_type_id); ?>" />
                                <span class="text-danger"><?php echo form_error($item->worker_type_id); ?></span>
                            </td>                   
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="form-group">
                <div class="col-sm-offset-4 col-lg-8 col-sm-8 text-left">
                    <input id="btn_add" name="btn_add" type="submit" class="btn btn-primary" value="Save" />
                    <a href="<?php echo site_url('demand_location/listAll'); ?>" class="btn btn-danger">Cancel</a></td>
                </div>
            </div>
        </fieldset>
        <?php echo form_close(); ?>
        <?php echo $this->session->flashdata('msg'); ?>

    </div>
