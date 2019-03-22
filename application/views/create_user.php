<div class="row">
    <?php echo $this->breadcrumbs->show(); ?>
</div>
<div class="row">
    <div class="col-sm-offset-3 col-lg-6 col-sm-6 well">
        <legend>Add User</legend>
        <?php echo $this->session->flashdata('msg'); ?>
        <?php
        $attributes = array("class" => "form-horizontal", "id" => "userform", "name" => "userform");
        echo form_open("user/create_user", $attributes);
        ?>
        <fieldset>

            <div class="form-group">
                <div class="row colbox">
                    <div class="col-lg-4 col-sm-4">
                        <label for="email" class="control-label m">Email * </label>
                    </div>
                    <div class="col-lg-8 col-sm-8">
                        <input id="email" name="email" placeholder="Email as Username" type="text" class="form-control"
                               value="<?php echo set_value('email'); ?>"/>
                        <span class="text-danger"><?php echo form_error('email'); ?></span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row colbox">
                    <div class="col-lg-4 col-sm-4">
                        <label for="first_name" class="control-label m">First name *</label>
                    </div>
                    <div class="col-lg-8 col-sm-8">
                        <input id="first_name" name="first_name" placeholder="First name" type="text"
                               class="form-control" value="<?php echo set_value('first_name'); ?>"/>
                        <span class="text-danger"><?php echo form_error('first_name'); ?></span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row colbox">
                    <div class="col-lg-4 col-sm-4">
                        <label for="last_name" class="control-label m">Last name *</label>
                    </div>
                    <div class="col-lg-8 col-sm-8">
                        <input id="last_name" name="last_name" placeholder="Last name" type="text" class="form-control"
                               value="<?php echo set_value('last_name'); ?>"/>
                        <span class="text-danger"><?php echo form_error('last_name'); ?></span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row colbox">
                    <div class="col-lg-4 col-sm-4">
                        <label for="phone" class="control-label">Phone Number</label>
                    </div>
                    <div class="col-lg-8 col-sm-8">
                        <input id="phone" name="phone" placeholder="Phone" type="text" class="form-control"
                               value="<?php echo set_value('phone'); ?>"/>
                        <span class="text-danger"><?php echo form_error('phone'); ?></span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row colbox">
                    <div class="col-lg-4 col-sm-4">
                        <label for="password" class="control-label m">Password *</label>
                    </div>
                    <div class="col-lg-8 col-sm-8">
                        <input id="password" name="password" placeholder="Password" type="text" class="form-control"
                               value="<?php echo set_value('password'); ?>"/>
                        <span class="text-danger"><?php echo form_error('password'); ?></span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row colbox">
                    <div class="col-lg-4 col-sm-4">
                        <label for="password_confirm" class="control-label m">Password Confirm *</label>
                    </div>
                    <div class="col-lg-8 col-sm-8">
                        <input id="password_confirm" name="password_confirm" placeholder="password confirm" type="text"
                               class="form-control" value="<?php echo set_value('password_confirm'); ?>"/>
                        <span class="text-danger"><?php echo form_error('password_confirm'); ?></span>
                    </div>
                </div>
            </div>

            <?php if ($this->ion_auth->is_admin()): ?>

                <div class="form-group">
                    <div class="row colbox">
                        <div class="col-lg-4 col-sm-4">
                            <label for="groups" class="control-label m">Select User groups *</label>
                        </div>
                        <div class="col-lg-8 col-sm-8">

                            <h3><?php echo lang('edit_user_groups_heading'); ?></h3>
                            <?php foreach ($groups as $group): ?>
                                <label class="checkbox">
                                    <?php
                                    $gID = $group['id'];
                                    $checked = null;
                                    $item = null;
                                    foreach ($currentGroups as $grp) {
                                        if ($gID == $grp->id) {
                                            $checked = ' checked="checked"';
                                            break;
                                        }
                                    }
                                    ?>
                                    <input type="checkbox" name="groups[]"
                                           value="<?php echo $group['id']; ?>"<?php echo $checked; ?>>
                                    <?php echo htmlspecialchars($group['name'], ENT_QUOTES, 'UTF-8'); ?>
                                </label>
                            <?php endforeach ?>


                        </div>
                    </div>
                </div>
            <?php endif ?>

            <div class="form-group">
                <div class="row colbox">
                    <div class="col-lg-4 col-sm-4">
                        <label for="company" class="control-label">Department</label>
                    </div>
                    <div class="col-lg-8 col-sm-8">
                        <input id="company" name="company" placeholder="Department" type="text" class="form-control"
                               value="<?php echo set_value('company'); ?>"/>
                        <span class="text-danger"><?php echo form_error('company'); ?></span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-4 col-lg-8 col-sm-8 text-left">
                    <input id="btn_add" name="btn_add" type="submit" class="btn btn-primary" value="Save"/>
                    <a href="<?php echo site_url('user/listAll'); ?>" class="btn btn-danger">Cancel</a></td>
                </div>
            </div>
        </fieldset>
        <?php echo form_close(); ?>

    </div>
</div>

