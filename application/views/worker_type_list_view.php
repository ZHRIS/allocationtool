<div class="row">
    <?php echo $this->breadcrumbs->show(); ?>
    <div class="list-group">
        <a href="<?php echo site_url('worker_type/listAll'); ?>" class="list-group-item">
            <h4 class="list-group-item-heading">Worker Types</h4>
            <p class="list-group-item-text">Enter the different types of workers.</p>
        </a>
    </div>
</div>
<div class="row">
    <?php echo $this->session->flashdata('msg'); ?>
    <table id="emp_table" class="table table-striped table-hover">        
        <caption><h4>
                <a href="<?php echo base_url(); ?>index.php/worker_type" class="btn btn-lg btn-primary" style="float: right;">Add Worker Type</a>
            </h4></caption>
        <thead>
            <tr>
                <th>Worker Type</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($list as $item): ?>
                <tr>
                    <td><?php echo $item->worker_type_name; ?></td>
                    <td>                        
                        <a href="<?php echo base_url(); ?>index.php/worker_type/update/<?php echo $item->worker_type_id; ?> " class="btn-sm btn-success">Edit</a>
                    </td> 
                    <td>                        
                        <a href="javascript: delete_worker_type(<?php echo $item->worker_type_id; ?>)" class="btn-sm btn-danger">Delete</a></td>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
