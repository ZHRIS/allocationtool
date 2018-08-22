<div class="row">
    <?php echo $this->breadcrumbs->show(); ?>
    <div class="list-group">
        <a href="<?php echo site_url('worker_level/listAll'); ?>" class="list-group-item">
            <h4 class="list-group-item-heading">Worker Levels</h4>
            <p class="list-group-item-text">Enter the different worker levels (for salaries purposes).</p>
        </a>
    </div>
</div>
<div class="row">

    <?php echo $this->session->flashdata('msg'); ?>

    <table id="emp_table" class="table table-striped table-hover">        
        <caption><h4>
                <a href="<?php echo base_url(); ?>index.php/worker_level" class="btn btn-lg btn-primary" style="float: right;">Add Worker Level</a>
            </h4></caption>
        <thead>
            <tr>
                <th>Worker Level</th>
                <th>Description</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($list as $item): ?>
                <tr>
                    <td><?php echo $item->worker_level_name; ?></td>
                    <td><?php echo $item->worker_level_description; ?></td>
                    <td>                        
                        <a href="<?php echo base_url(); ?>index.php/worker_level/update/<?php echo $item->worker_level_id; ?> " class="btn-sm btn-success">Edit</a>
                    </td>
                    <td>
                        <a href="javascript: delete_worker_level(<?php echo $item->worker_level_id; ?>)" class="btn-sm btn-danger">Delete</a></td>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
