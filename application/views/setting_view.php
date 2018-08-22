<div class="row">
    <?php echo $this->breadcrumbs->show(); ?>
</div>
<div class="row">
    <div class="col-sm-offset-3 col-lg-6 col-sm-6 well">
        <legend>Optimization Settings </legend>
        <?php
        $attributes = array("class" => "form-horizontal", "id" => "employeeform", "name" => "employeeform");
        echo form_open("setting/index", $attributes);
        ?>
        <fieldset>

            <div class="form-group">
                <div class="row colbox">
                    <div class="col-lg-4 col-sm-4">
                        <label for="maximum_running_time" class="control-label m">Maximum Running Time (Minutes) *</label>
                    </div>
                    <div class="col-lg-8 col-sm-8">
                        <input id="maximum_running_time" name="maximum_running_time" placeholder="Maximum Running Time" type="text" class="form-control" value="<?php echo set_value('maximum_running_time'); ?>" />
                        <span class="text-danger"><?php echo form_error('maximum_running_time'); ?></span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row colbox">
                    <div class="col-lg-4 col-sm-4">
                        <label for="optimality_gap" class="control-label m">Optimality Gap *</label>
                    </div>
                    <div class="col-lg-8 col-sm-8">
                        <input id="optimality_gap" name="optimality_gap" placeholder="Optimality Gap" type="text" class="form-control" value="<?php echo set_value('optimality_gap'); ?>" />
                        <span class="text-danger"><?php echo form_error('optimality_gap'); ?></span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row colbox">
                    <div class="col-lg-4 col-sm-4">
                        <label for="harvesine_formula" class="control-label m">Harvesine Formula *</label>
                    </div>
                    <div class="col-lg-8 col-sm-8">
                        <input id="harvesine_formula" name="harvesine_formula" placeholder="Harvesine Formula" type="text" class="form-control" value="<?php echo set_value('harvesine_formula'); ?>" />
                        <span class="text-danger"><?php echo form_error('harvesine_formula'); ?></span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row colbox">
                    <div class="col-lg-4 col-sm-4">
                        <label for="maximum_weight" class="control-label m">Maximum Weight Allowed *</label>
                    </div>
                    <div class="col-lg-8 col-sm-8">
                        <input id="harvesine_formula" name="maximum_weight" placeholder="Maximum Preferecence Weight Allowed" type="text" class="form-control" value="<?php echo set_value('maximum_weight'); ?>" />
                        <span class="text-danger"><?php echo form_error('maximum_weight'); ?></span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row colbox">
                    <div class="col-lg-4 col-sm-4">
                        <label for="tool_currency" class="control-label m">Currency *</label>
                    </div>
                    <div class="col-lg-8 col-sm-8">
                        <?php
                        $attributes = 'class = "form-control" id = "gender"';
                        echo form_dropdown('tool_currency', $tool_currency, set_value('tool_currency'), $attributes);
                        ?>
                        <span class="text-danger"><?php echo form_error('tool_currency'); ?></span>

                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row colbox">
                    <div class="col-lg-4 col-sm-4">
                        <label for="total_budget" class="control-label">Total Budget</label>
                    </div>
                    <div class="col-lg-8 col-sm-8">
                        <input id="total_budget" name="total_budget" placeholder="Total budget" type="text" class="form-control" value="<?php echo set_value('total_budget'); ?>" />
                        <span class="text-danger"><?php echo form_error('total_budget'); ?></span>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <div class="row colbox">
                    <div class="col-lg-4 col-sm-4">
                        <label for="default_penalty_unfulfilled_demand" class="control-label m">Default penalty unfulfilled demand *</label>
                    </div>
                    <div class="col-lg-8 col-sm-8">
                        <input id="default_penalty_unfulfilled_demand" name="default_penalty_unfulfilled_demand" placeholder="default_penalty_unfulfilled_demand" type="text" class="form-control" value="<?php echo set_value('default_penalty_unfulfilled_demand'); ?>" />
                        <span class="text-danger"><?php echo form_error('default_penalty_unfulfilled_demand'); ?></span>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <div class="row colbox">
                    <div class="col-lg-4 col-sm-4">
                        <label for="number_of_preferences_allowed" class="control-label m">Number of Preferences allowed *</label>
                    </div>
                    <div class="col-lg-8 col-sm-8">
                        <input id="number_of_preferences_allowed" name="number_of_preferences_allowed" placeholder="number_of_preferences_allowed" type="text" class="form-control" value="<?php echo set_value('number_of_preferences_allowed'); ?>" />
                        <span class="text-danger"><?php echo form_error('number_of_preferences_allowed'); ?></span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row colbox">
                    <div class="col-lg-4 col-sm-4">
                        <label for="tool_currency" class="control-label m">Platform *</label>
                    </div>
                    <div class="col-lg-8 col-sm-8">
                        <?php
                        $attributes = 'class = "form-control" id = "platform"';
                        echo form_dropdown('platform', $platform, set_value('platform'), $attributes);
                        ?>
                        <span class="text-danger"><?php echo form_error('platform'); ?></span>

                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-4 col-lg-8 col-sm-8 text-left">
                    <input id="btn_add" name="btn_add" type="submit" class="btn btn-primary" value="Save" />
                    <a href="<?php echo site_url('setting/listAll'); ?>" class="btn btn-danger">Cancel</a></td>
                </div>
            </div>

        </fieldset>
        <?php echo form_close(); ?>
        <?php echo $this->session->flashdata('msg'); ?>
    </div>
</div>
