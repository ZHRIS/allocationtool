<div class="row">    
    <div class="col-sm-offset-3 col-lg-6 col-sm-6 well">
        <?php
        $attributes = array("class" => "form-horizontal", "id" => "loginform", "name" => "loginform");
        echo form_open("login/login", $attributes);
        ?>
        <fieldset>
            <legend>Login - Allocation Optimization Tool</legend>
            <div class="form-group">
                <div class="row colbox">
                    <div class="col-lg-4 col-sm-4">
                        <label for="identity" class="control-label">Username</label>
                    </div>
                    <div class="col-lg-8 col-sm-8">
                        <input class="form-control" id="identity" name="identity" placeholder="username" type="text" value="<?php echo set_value('identity'); ?>" />
                        <span class="text-danger"><?php echo form_error('identity'); ?></span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row colbox">
                    <div class="col-lg-4 col-sm-4">
                        <label for="password" class="control-label">Password</label>
                    </div>
                    <div class="col-lg-8 col-sm-8">
                        <input class="form-control" id="password" name="password" placeholder="Password" type="password" value="<?php echo set_value('password'); ?>" />
                        <span class="text-danger"><?php echo form_error('password'); ?></span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-lg-12 col-sm-12 text-center">
                    <input id="btn_login" name="btn_login" type="submit" class="btn btn-default" value="Login" />
                    <input id="btn_cancel" name="btn_cancel" type="reset" class="btn btn-default" value="Cancel" />
                </div>
            </div>
        </fieldset>
         <?php echo form_close(); ?>
        <?php echo $this->session->flashdata('msg'); ?>
    </div
</div>
</div>