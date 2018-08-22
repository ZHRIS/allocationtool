<div class="row">
    <?php echo $this->breadcrumbs->show(); ?>
</div>
<div class="row">
    <div class="col-sm-offset-3 col-lg-6 col-sm-6 well">
        <legend>Update User Profile</legend>
        <?php
        $attributes = array("class" => "form-horizontal", "id" => "userform", "name" => "userform");
        echo form_open("user/edit_user/" . $emp->id, $attributes);
        ?>
        <fieldset>

            <div class="form-group">
                <div class="row colbox">
                    <div class="col-lg-4 col-sm-4">
                        <label for="username" class="control-label">Username</label>
                    </div>
                    <div class="col-lg-8 col-sm-8">
                        <input id="username" name="username" placeholder="username" type="text" class="form-control"  value="<?php echo $emp->username; ?>" />
                        <span class="text-danger"><?php echo form_error('username'); ?></span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row colbox">
                    <div class="col-lg-4 col-sm-4">
                        <label for="first_name" class="control-label">First name</label>
                    </div>
                    <div class="col-lg-8 col-sm-8">
                        <input id="first_name" name="first_name" placeholder="first_name" type="text" class="form-control"  value="<?php echo $emp->first_name; ?>" />
                        <span class="text-danger"><?php echo form_error('first_name'); ?></span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row colbox">
                    <div class="col-lg-4 col-sm-4">
                        <label for="last_name" class="control-label">Last name</label>
                    </div>
                    <div class="col-lg-8 col-sm-8">
                        <input id="last_name" name="last_name" placeholder="last_name" type="text" class="form-control"  value="<?php echo $emp->last_name; ?>" />
                        <span class="text-danger"><?php echo form_error('last_name'); ?></span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row colbox">
                    <div class="col-lg-4 col-sm-4">
                        <label for="email" class="control-label">Email</label>
                    </div>
                    <div class="col-lg-8 col-sm-8">
                        <input id="email" name="email" placeholder="email" type="text" class="form-control" value="<?php echo $emp->email; ?>" />
                        <span class="text-danger"><?php echo form_error('email'); ?></span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row colbox">
                    <div class="col-lg-4 col-sm-4">
                        <label for="phone" class="control-label">Phone Number</label>
                    </div>
                    <div class="col-lg-8 col-sm-8">
                        <input id="phone" name="phone" placeholder="phone" type="text" class="form-control" value="<?php echo $emp->phone; ?>" />
                        <span class="text-danger"><?php echo form_error('phone'); ?></span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row colbox">
                    <div class="col-lg-4 col-sm-4">
                        <label for="company" class="control-label">Department</label>
                    </div>
                    <div class="col-lg-8 col-sm-8">
                        <input id="company" name="company" placeholder="department" type="text" class="form-control" value="<?php echo $emp->company; ?>" />
                        <span class="text-danger"><?php echo form_error('company'); ?></span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row colbox">
                    <div class="col-lg-4 col-sm-4">
                        <label for="usergroup" class="control-label">User Groups</label>
                    </div>
                    <div class="col-lg-8 col-sm-8">
                        <?php if ($this->ion_auth->is_admin()): ?>
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
                                    <input type="checkbox" name="groups[]" value="<?php echo $group['id']; ?>"<?php echo $checked; ?>>
                                    <?php echo htmlspecialchars($group['name'], ENT_QUOTES, 'UTF-8'); ?>
                                </label>
                            <?php endforeach ?>

                        <?php endif ?>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-4 col-lg-8 col-sm-8 text-left">
                    <input id="btn_add" name="btn_add" type="submit" class="btn btn-primary" value="Save" />
                    <a href="<?php echo site_url('user/listAll'); ?>" class="btn btn-danger">Cancel</a></td>
                </div>
            </div>
        </fieldset>        
        <?php echo form_close(); ?>
        <?php echo $this->session->flashdata('msg'); ?>

    </div>
</div>
