<div class="row">
    <?php echo $this->breadcrumbs->show(); ?>
</div>
<div class="row">
    <div class="col-sm-offset-3 col-lg-6 col-sm-6 well">
        <legend>Update Worker Level Details</legend>
        <?php
        $attributes = array("class" => "form-horizontal", "id" => "workerLevelForm", "name" => "workerLevelForm");
        echo form_open("worker_level/update/" . $emp->worker_level_id, $attributes);
        ?>
        <fieldset>

          
            <div class="form-group">
                <div class="row colbox">
                    <div class="col-lg-4 col-sm-4">
                        <label for="worker_level_name" class="control-label">Worker Level *</label>
                    </div>
                    <div class="col-lg-8 col-sm-8">
                        <input id="worker_level_name" name="worker_level_name" placeholder="Worker Level Name" type="text" class="form-control" value="<?php echo $emp->worker_level_name; ?>" />
                        <span class="text-danger"><?php echo form_error('worker_level_name'); ?></span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row colbox">
                    <div class="col-lg-4 col-sm-4">
                        <label for="worker_level_description" class="control-label">Worker Level Description *</label>
                    </div>
                    <div class="col-lg-8 col-sm-8">
                        <input id="worker_level_name" name="worker_level_description" placeholder="Worker Level Description" type="text" class="form-control" value="<?php echo $emp->worker_level_description; ?>" />
                        <span class="text-danger"><?php echo form_error('worker_level_description'); ?></span>
                    </div>
                </div>
            </div>

            
            <div class="form-group">
                <div class="col-sm-offset-4 col-lg-8 col-sm-8 text-left">
                    <input id="btn_add" name="btn_add" type="submit" class="btn btn-primary" value="Save" />
                    <a href="<?php echo site_url('worker_level/listAll'); ?>" class="btn btn-danger">Cancel</a></td>
                </div>
            </div>
            
        </fieldset>
        <?php echo form_close(); ?>
        <?php echo $this->session->flashdata('msg'); ?>
    </div>
</div>
