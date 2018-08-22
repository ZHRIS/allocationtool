<div class="row">
    <?php echo $this->breadcrumbs->show(); ?>

    <div class="list-group">

        <a href="<?php echo site_url('user/listAll'); ?>" class="list-group-item">
            <h4 class="list-group-item-heading">Users</h4>
            <p class="list-group-item-text">Add remove and edit system user details.</p>
        </a>
    </div>
</div>
<div class="row">
    <?php echo $this->session->flashdata('msg'); ?>
    <table class="table table-striped table-hover">
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Groups</th>
            <th>Status</th>
            <th></th>
        </tr>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo $user->first_name; ?></td>
                <td><?php echo $user->last_name; ?></td>
                <td><?php echo $user->email; ?></td>
                <td>
                    | <?php foreach ($user->groups as $group): ?>
                        <?php echo $group->name; ?> |
                    <?php endforeach ?>
                </td>
                <td>
                    <a href="javascript: delete_user(<?php echo $user->id; ?>)" class="btn-sm btn-danger">Delete</a>
                </td>
                </td>
                <td>
                    <a href="<?php echo base_url(); ?>index.php/user/edit_user/<?php echo $user->id; ?> "
                       class="btn-sm btn-success">Edit</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <p>
        <a href="<?php echo base_url(); ?>index.php/user/create_user" class="btn-sm btn-primary">Create User</a>
        <a href="<?php echo base_url(); ?>index.php/user/create_group" class="btn-sm btn-primary">Create User Group</a>
    </p>

</div>