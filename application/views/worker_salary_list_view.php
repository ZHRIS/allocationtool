<div class="row">
    <?php echo $this->breadcrumbs->show(); ?>
    <div class="list-group">
        <a href="<?php echo site_url('worker_salary/listAll'); ?>" class="list-group-item">
            <h4 class="list-group-item-heading">Worker Salary</h4>
            <p class="list-group-item-text">Enter default worker salaries for each combination of worker type and level.</p>
        </a>
    </div>
</div>
<div class="row">
    <br/>
    <?php echo $this->session->flashdata('msg'); ?>

    <table id="emp_table" class="table table-striped table-hover">        
        <caption><h4>
                <a href="<?php echo base_url(); ?>index.php/worker_salary" class="btn btn-lg btn-primary" style="float: right;">Add Worker Salary</a>
            </h4></caption>
        <thead>
            <tr>
                <th>Worker Type</th>
                <th>Level</th>                
                <th>Salary <label class="m"> (<?php echo $tool_currency; ?>) </label> </th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($list as $item): ?>
                <tr>
                    <td><?php echo $item->worker_type_name; ?></td>
                    <td><?php echo $item->worker_level_name; ?></td>
                    <td><?php echo $item->salary; ?></td>
                    <td>                        
                        <a href="<?php echo base_url(); ?>index.php/worker_salary/update/<?php echo $item->worker_salary_id; ?> " class="btn-sm btn-success">Edit</a>
                    </td> 
                    <td>                        
                        <a href="javascript: delete_worker_salary(<?php echo $item->worker_salary_id; ?>)" class="btn-sm btn-danger">Delete</a></td>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
