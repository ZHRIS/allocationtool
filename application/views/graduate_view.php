<div class="row">
    <?php echo $this->breadcrumbs->show(); ?>
</div>
<div class="row">
    <div class="col-sm-offset-3 col-lg-6 col-sm-6 well">
        <legend>Add Worker Details</legend>
        <?php
        $attributes = array("class" => "form-horizontal", "id" => "graduateform", "name" => "graduateform");
        echo form_open("graduate/index", $attributes);
        ?>
        <fieldset>

            <?php echo $this->session->flashdata('msg'); ?>

            <div class="form-group">
                <div class="row colbox">

                    <div class="col-lg-4 col-sm-4">
                        <label for="graduate_no" class="control-label m">Graduate # *</label>
                    </div>
                    <div class="col-lg-8 col-sm-8">
                        <input id="graduate_no" name="graduate_no" placeholder="Graduate Number" type="text"
                               class="form-control" value="<?php echo set_value('graduate_no'); ?>"/>
                        <span class="text-danger"><?php echo form_error('graduate_no'); ?></span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row colbox">
                    <div class="col-lg-4 col-sm-4">
                        <label for="first_name" class="control-label m">First Name *</label>
                    </div>
                    <div class="col-lg-8 col-sm-8">
                        <input id="first_name" name="first_name" placeholder="first name" type="text"
                               class="form-control" value="<?php echo set_value('first_name'); ?>"/>
                        <span class="text-danger"><?php echo form_error('first_name'); ?></span>
                    </div>
                </div>
            </div>


            <div class="form-group">
                <div class="row colbox">
                    <div class="col-lg-4 col-sm-4">
                        <label for="last_name" class="control-label m">Last Name *</label>
                    </div>
                    <div class="col-lg-8 col-sm-8">
                        <input id="last_name" name="last_name" placeholder="last name" type="text" class="form-control"
                               value="<?php echo set_value('last_name'); ?>"/>
                        <span class="text-danger"><?php echo form_error('last_name'); ?></span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row colbox">
                    <div class="col-lg-4 col-sm-4">
                        <label for="dob" class="control-label m">Date of Birth</label>
                    </div>
                    <div class="col-lg-8 col-sm-8">
                        <input id="dob" name="dob" placeholder="dd/MM/yyyy" type="text" class="form-control"
                               value="<?php echo set_value('dob'); ?>"/>
                        <span class="text-danger"><?php echo form_error('dob'); ?></span>
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
                        echo form_dropdown('location_id', $location_id, set_value('location_id'), $attributes);
                        ?>
                        <span class="text-danger"><?php echo form_error('location_id'); ?></span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row colbox">
                    <div class="col-lg-4 col-sm-4">
                        <label for="worker_type_id" class="control-label m">Worker Type *</label>
                    </div>
                    <div class="col-lg-8 col-sm-8">
                        <?php
                        $attributes = 'class = "form-control" id = "worker_type_id"';
                        echo form_dropdown('worker_type_id', $worker_type_id, set_value('worker_type_id'), $attributes);
                        ?>
                        <span class="text-danger"><?php echo form_error('worker_type_id'); ?></span>

                    </div>
                </div>
            </div>


            <div class="form-group">
                <div class="row colbox">
                    <div class="col-lg-4 col-sm-4">
                        <label for="worker_level_id" class="control-label m">Worker Level (Grade)*</label>
                    </div>
                    <div class="col-lg-8 col-sm-8">
                        <?php
                        $attributes = 'class = "form-control" id = "worker_level_id"';
                        echo form_dropdown('worker_level_id', $worker_level_id, set_value('worker_level_id'), $attributes);
                        ?>
                        <span class="text-danger"><?php echo form_error('worker_level_id'); ?></span>

                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row colbox">
                    <div class="col-lg-4 col-sm-4">
                        <label for="gender" class="control-label m">Gender *</label>
                    </div>
                    <div class="col-lg-8 col-sm-8">
                        <?php
                        $attributes = 'class = "form-control" id = "gender"';
                        echo form_dropdown('gender', $gender, set_value('gender'), $attributes);
                        ?>
                        <span class="text-danger"><?php echo form_error('gender'); ?></span>

                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row colbox">
                    <div class="col-lg-4 col-sm-4">
                        <label for="adjusted_salary" class="control-label">Adjusted Salary </label>
                    </div>
                    <div class="col-lg-8 col-sm-8">
                        <input id="adjusted_salary" name="adjusted_salary" placeholder="adjusted salary" type="text"
                               class="form-control" value="<?php echo set_value('adjusted_salary'); ?>"/>
                        <span class="text-danger"><?php echo form_error('adjusted_salary'); ?></span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row colbox">
                    <div class="col-lg-4 col-sm-4">
                        <label for="assigned_to_fixed_location" class="control-label">Assigned to fixed location</label>
                    </div>
                    <div class="col-lg-8 col-sm-8">
                        <?php
                        $attributes = 'class = "form-control" id = "do_not_assign_outside_preferences"';
                        echo form_dropdown('assigned_to_fixed_location', $assigned_to_fixed_location, set_value('assigned_to_fixed_location'), $attributes);
                        ?>
                        <span class="text-danger"><?php echo form_error('assigned_to_fixed_location'); ?></span>

                    </div>
                </div>
            </div>

            <div class="form-group" id="potential_fixed_location_selection">
                <div class="row colbox">
                    <div class="col-lg-4 col-sm-4">
                        <label for="potential_fixed_location_id" class="control-label">Potential fixed location</label>
                    </div>
                    <div class="col-lg-8 col-sm-8">
                        <?php
                        $attributes = 'class = "form-control" id = "potential_fixed_location_id"';
                        echo form_dropdown('potential_fixed_location_id', $potential_fixed_location_id, set_value('potential_fixed_location_id'), $attributes);
                        ?>
                        <span class="text-danger"><?php echo form_error('potential_fixed_location_id'); ?></span>

                    </div>
                </div>
            </div>


            <div class="form-group">
                <div class="row colbox">
                    <div class="col-lg-4 col-sm-4">
                        <label for="do_not_assign_outside_preferences" class="control-label">Assign Outside of Preferences?</label>
                    </div>
                    <div class="col-lg-8 col-sm-8">
                        <?php
                        $attributes = 'class = "form-control" id = "do_not_assign_outside_preferences"';
                        echo form_dropdown('do_not_assign_outside_preferences', $do_not_assign_outside_preferences, set_value('do_not_assign_outside_preferences'), $attributes);
                        ?>
                        <span class="text-danger"><?php echo form_error('do_not_assign_outside_preferences'); ?></span>

                    </div>
                </div>
            </div>

            <?php {
                for ($i = 0; $i < $numberOfPreferenceAllowed; $i++) {
                    echo ' <div class="form-group"> ';
                    echo ' <div class="row colbox"> ';
                    echo ' <div class="col-lg-4 col-sm-4"> ';
                    echo ' <label for="preference' . $i . '" class="control-label m">Preference *' . ($i + 1) . '</label>';
                    echo '  </div> ';
                    echo ' <div class="col-lg-8 col-sm-8"> ';
                    $attributes = 'class = "form-control" id = "' . 'preference' . $i . '"';
                    echo form_dropdown('preference' . $i, $demand_location_id, set_value('preference' . $i), $attributes);
                    echo ' <span class="text-danger">' . form_error('preference' . $i) . '</span>';
                    echo ' </div> ';
                    echo ' </div> ';
                    echo ' </div> ';
                }
            }
            ?>
            <div class="form-group">
                <div class="col-sm-offset-4 col-lg-8 col-sm-8 text-left">
                    <input id="btn_add" name="btn_add" type="submit" class="btn btn-primary" value="Save"/>
                    <a href="<?php echo site_url('graduate/listAll'); ?>" class="btn btn-danger">Cancel</a></td>
                </div>
            </div>
        </fieldset>
        <?php echo form_close();
        ?>
    </div>
</div>

