<div class="row">
    <?php echo $this->breadcrumbs->show(); ?>
</div>
<div class="row">
    <div class="col-sm-offset-3 col-lg-6 col-sm-6 well">
        <legend>Update Study Location Details</legend>
        <?php
        $attributes = array("class" => "form-horizontal", "id" => "workerTypeForm", "name" => "workerTypeForm");
        echo form_open("location/update/" . $emp->location_id, $attributes);
        ?>
        <fieldset>

            <div class="form-group">
                <div class="row colbox">
                    <div class="col-lg-4 col-sm-4">
                        <label for="location_name" class="control-label m">Location Name *</label>
                    </div>
                    <div class="col-lg-8 col-sm-8">
                        <input id="location_name" name="location_name" placeholder="Location Name" type="text" class="form-control" value="<?php echo $emp->location_name; ?>" />
                        <span class="text-danger"><?php echo form_error('location_name'); ?></span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row colbox">
                    <div class="col-lg-4 col-sm-4">
                        <label for="longitude_coordinate" class="control-label">Longitude Coordinate</label>
                    </div>
                    <div class="col-lg-8 col-sm-8">
                        <input id="longitude_coordinate" name="longitude_coordinate" placeholder="longitude coordinate" type="text" class="form-control" value="<?php echo $emp->longitude_coordinate; ?>" />
                        <span class="text-danger"><?php echo form_error('longitude_coordinate'); ?></span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row colbox">
                    <div class="col-lg-4 col-sm-4">
                        <label for="latitude_coordinate" class="control-label">Latitude Coordinate</label>
                    </div>
                    <div class="col-lg-8 col-sm-8">
                        <input id="latitude_coordinate" name="latitude_coordinate" placeholder="latitude coordinate" type="text" class="form-control" value="<?php echo $emp->latitude_coordinate; ?>" />
                        <span class="text-danger"><?php echo form_error('latitude_coordinate'); ?></span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-4 col-lg-8 col-sm-8 text-left">
                    <input id="btn_add" name="btn_add" type="submit" class="btn btn-primary" value="Save" />
                    <a href="<?php echo site_url('location/listAll'); ?>" class="btn btn-danger">Cancel</a></td>
                </div>
            </div>

        </fieldset>
        <?php echo form_close(); ?>
        <?php echo $this->session->flashdata('msg'); ?>
    </div>
</div>
