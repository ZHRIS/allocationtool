<div class="row">
    <?php echo $this->breadcrumbs->show(); ?>
</div>
<div class="row">
    <div class="col-sm-offset-3 col-lg-6 col-sm-6 well">
        <legend>Update Worker Salary</legend>
        <?php
        $attributes = array("class" => "form-horizontal", "id" => "workerTypeForm", "name" => "workerTypeForm");
        echo form_open("worker_salary/update/" . $emp->worker_salary_id, $attributes);
        ?>
        <fieldset>


            <div class="form-group">
                <div class="row colbox">
                    <div class="col-lg-4 col-sm-4">
                        <label for="salary" class="control-label m">Salary * (<?php echo $tool_currency; ?>) </label>
                    </div>
                    <div class="col-lg-8 col-sm-8">
                        <input id="salary" name="salary" placeholder="Salary" type="text" class="form-control" value="<?php echo $emp->salary; ?>" />
                        <span class="text-danger"><?php echo form_error('salary'); ?></span>
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
                        echo form_dropdown('worker_type_id', $worker_type_id, set_value('worker_type_id', $emp->worker_type_id), $attributes);
                        ?>
                        <span class="text-danger"><?php echo form_error('worker_type_id'); ?></span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row colbox">
                    <div class="col-lg-4 col-sm-4">
                        <label for="worker_level_id" class="control-label m">Worker Level *</label>
                    </div>
                    <div class="col-lg-8 col-sm-8">

                        <?php
                        $attributes = 'class = "form-control" id = "worker_level_id"';
                        echo form_dropdown('worker_level_id', $worker_level_id, set_value('worker_level_id', $emp->worker_level_id), $attributes);
                        ?>
                        <span class="text-danger"><?php echo form_error('worker_level_id'); ?></span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-4 col-lg-8 col-sm-8 text-left">
                    <input id="btn_add" name="btn_add" type="submit" class="btn btn-primary" value="Save" />
                    <a href="<?php echo site_url('worker_salary/listAll'); ?>" class="btn btn-danger">Cancel</a></td>
                </div>
            </div>

        </fieldset>
        <?php echo form_close(); ?>
        <?php echo $this->session->flashdata('msg'); ?>
    </div>
</div>
