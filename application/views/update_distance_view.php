<div class="row">
    <?php echo $this->breadcrumbs->show(); ?>
</div>
<div class="row">
    <div class="col-sm-offset-3 col-lg-6 col-sm-6 well">
        <legend>Update Distance Lookup </legend>
        <?php
        $attributes = array("class" => "form-horizontal", "id" => "distanceform", "name" => "distanceform");
        echo form_open("distance/update/" . $emp->distance_id, $attributes);
        ?>
        <fieldset>

            <div class="form-group">
                <div class="row colbox">
                    <div class="col-lg-4 col-sm-4">
                        <label for="location_id" class="control-label m">Study Location *</label>
                    </div>
                    <div class="col-lg-8 col-sm-8">

                        <?php
                        $attributes = 'class = "form-control" id = "demand_location_id"';
                        echo form_dropdown('demand_location_id', $demand_location_id, set_value('demand_location_id', $emp->demand_location_id), $attributes);
                        ?>
                        <span class="text-danger"><?php echo form_error('demand_location_id'); ?></span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row colbox">
                    <div class="col-lg-4 col-sm-4">
                        <label for="location_id" class="control-label m">Study Location *</label>
                    </div>
                    <div class="col-lg-8 col-sm-8">

                        <?php
                        $attributes = 'class = "form-control" id = "location_id"';
                        echo form_dropdown('location_id', $location_id, set_value('location_id', $emp->location_id), $attributes);
                        ?>
                        <span class="text-danger"><?php echo form_error('location_id'); ?></span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row colbox">
                    <div class="col-lg-4 col-sm-4">
                        <label for="road_distance" class="control-label m">Road Distance *</label>
                    </div>
                    <div class="col-lg-8 col-sm-8">
                        <input id="road_distance" name="road_distance" placeholder="road distance" type="text" class="form-control"  value="<?php echo $emp->road_distance; ?>" />
                        <span class="text-danger"><?php echo form_error('road_distance'); ?></span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-4 col-lg-8 col-sm-8 text-left">
                    <input id="btn_add" name="btn_add" type="submit" class="btn btn-primary" value="Update" />
                    <a href="<?php echo site_url('distance/listAll'); ?>" class="btn btn-danger">Cancel</a></td>
                </div>
            </div>

        </fieldset>
        <?php echo form_close(); ?>
        <?php echo $this->session->flashdata('msg'); ?>
    </div>
</div>