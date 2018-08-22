<div class="row">
    <?php echo $this->breadcrumbs->show(); ?>
</div>
<div class="row">
    <div class="col-sm-offset-3 col-lg-6 col-sm-6 well">
        <legend>Change Password</legend>

        <div id="infoMessage"><?php echo $msg; ?></div>

        <?php echo form_open("user/change_password"); ?>
        <div class="form-group">
            <div class="row colbox">
                <div class="col-lg-4 col-sm-4">
                    <label for="change_password_old_password_label" class="control-label m">Old Password *</label>
                </div>
                <div class="col-lg-8 col-sm-8">
                    <?php echo form_input($old_password); ?>
                    <span class="text-danger"><?php echo form_error('old_password'); ?></span>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="row colbox">
                <div class="col-lg-4 col-sm-4">
                    <label for="new_password" class="control-label m">New
                        Password<?php echo sprintf(lang('change_password_new_password_label'), $min_password_length); ?></label>
                </div>
                <div class="col-lg-8 col-sm-8">
                    <?php echo form_input($new_password); ?>
                    <span class="text-danger"><?php echo form_error('old_password'); ?></span>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="row colbox">
                <div class="col-lg-4 col-sm-4">
                    <label for="new_password" class="control-label m">Confirm New
                        Password<?php echo lang('change_password_new_password_confirm_label', 'new_password_confirm'); ?> </label>
                </div>
                <div class="col-lg-8 col-sm-8">
                    <?php echo form_input($new_password_confirm); ?>
                </div>
            </div>
        </div>
        <?php echo form_input($user_id); ?>
        <p><?php echo form_submit('submit', "Change Password", lang('change_password_submit_btn')); ?></p>

        <?php echo form_close(); ?>


    </div>
</div>


