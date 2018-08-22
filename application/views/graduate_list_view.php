<div class="row">
    <?php echo $this->breadcrumbs->show(); ?>
    <div class="list-group">
        <a href="<?php echo site_url('graduate/listAll'); ?>" class="list-group-item">
            <h4 class="list-group-item-heading">Worker Settings</h4>
            <p class="list-group-item-text">Enter the workers information: study location (to compute distances),type, level, adjusted salary and fixed location (if any), and preferences.</p>
        </a>
    </div>
</div>
<div class="row">
    <?php echo $this->session->flashdata('msg'); ?>
    <br/>
    <table id="emp_table" class="table table-striped table-hover">
        <caption><h4><a href="<?php echo base_url(); ?>index.php/graduate" class="btn btn-lg btn-primary" style="float: right;">Add New Worker</a></h4></caption>
        <thead>
            <tr>
                <th>Graduate #</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Worker Type</th>
                <th>Gender</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($graduate_list as $item): ?>
                <tr>
                    <td><?php echo $item->graduate_no; ?></td>
                    <td><?php echo $item->first_name; ?></td>
                    <td><?php echo $item->last_name; ?></td>
                    <td><?php echo $item->worker_type_name; ?></td>
                    <td><?php echo $item->gender; ?></td>
                    <td>
                        <a href="<?php echo base_url(); ?>index.php/graduate/dashboard/<?php echo $item->graduate_id; ?> " class="btn-sm btn-success">View</a>
                    </td>
                    <td>
                        <a href="javascript: delete_graduate(<?php echo $item->graduate_id; ?>)" class="btn-sm btn-danger">Delete</a></td>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
