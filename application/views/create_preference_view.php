<div class="row">
    <?php echo $this->breadcrumbs->show(); ?>
</div>
<div class="row">
    <div class="col-sm-offset-3 col-lg-6 col-sm-6 well">
        <legend>Worker Preference</legend>
        <?php
        $attributes = array("class" => "form-horizontal", "id" => "preferencform", "name" => "preferencform");
        echo form_open("graduate/createPreference/" . $emp->graduate_id, $attributes);
        ?>
        <fieldset>


            <div class="form-group">
                <div class="row colbox">
                    <div class="col-lg-4 col-sm-4">
                        <label for="full_name" class="control-label">Full Name</label>
                    </div>
                    <div class="col-lg-8 col-sm-8">
                        <?php echo $emp->first_name; ?> <?php echo $emp->last_name; ?>
                    </div>
                </div>
            </div>
            <div class="form-group">


                <div class="row colbox">

                    <div class="col-lg-4 col-sm-4">
                        <label for="demand_location_id" class="control-label">Worker Preference</label>
                    </div>

                    <div class="col-lg-8 col-sm-8">

                        <?php
                        $attributes = 'class = "form-control" id = "demand_location_id"';
                        echo form_dropdown('demand_location_id', $demand_location_id, set_value('demand_location_id'), $attributes);
                        ?>
                        <span class="text-danger"><?php echo form_error('demand_location_id'); ?></span>

                    </div>


                </div>

            </div>
            <div class="form-group">
                <div class="col-sm-offset-4 col-lg-8 col-sm-8 text-left">
                    <input id="btn_add" name="btn_add" type="submit" class="btn btn-primary" value="Save" />
                    <a href="<?php echo site_url('graduate/dashboard/' . $emp->graduate_id); ?>" class="btn btn-danger">Cancel</a></td>
                </div>
            </div>
            <input type="hidden" name="graduate_id" value="<?php print $emp->graduate_id ?>"/>
        </fieldset>

        <?php echo form_close(); ?>
        <?php echo $this->session->flashdata('msg'); ?>
    </div>
</div>