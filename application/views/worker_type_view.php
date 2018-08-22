<div class="row">
    <?php echo $this->breadcrumbs->show(); ?>
</div>
<div class="row">
    <div class="col-sm-offset-3 col-lg-6 col-sm-6 well">
        <legend>Add Worker Type Details</legend>
        <?php
        $attributes = array("class" => "form-horizontal", "id" => "employeeform", "name" => "employeeform");
        echo form_open("worker_type/index", $attributes);
        ?>
        <fieldset>

          
            <div class="form-group">
                <div class="row colbox">
                    <div class="col-lg-4 col-sm-4">
                        <label for="worker_type_name" class="control-label m">Worker Type Name *</label>
                    </div>
                    <div class="col-lg-8 col-sm-8">
                        <input id="worker_type_name" name="worker_type_name" placeholder="Worker Type Name" type="text" class="form-control" value="<?php echo set_value('worker_type_name'); ?>" />
                        <span class="text-danger"><?php echo form_error('worker_type_name'); ?></span>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-sm-offset-4 col-lg-8 col-sm-8 text-left">
                    <input id="btn_add" name="btn_add" type="submit" class="btn btn-primary" value="Save" />
                    <a href="<?php echo site_url('worker_type/listAll'); ?>" class="btn btn-danger">Cancel</a></td>
                </div>
            </div>
            
        </fieldset>
        <?php echo form_close(); ?>
        <?php echo $this->session->flashdata('msg'); ?>
    </div>
</div>
