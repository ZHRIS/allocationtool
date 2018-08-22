<!-- Page Heading -->
<div class="row">
    <?php echo $this->breadcrumbs->show(); ?>
</div>

<div class="row">

    <table id="emp_table" class="table table-striped table-hover">
        <thead>
        <tr>
            <th>Date & Time</th>
            <th>Records uploaded</th>
            <th>Records not uploaded</th>
            <th>Uploaded by</th>
            <th>Upload Failure Reasons</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($upload_list as $item): ?>
            <tr>
                <td><?php echo $item->upload_date; ?></td>
                <td><?php echo $item->records_uploaded; ?></td>
                <td><?php echo $item->records_notuploaded; ?></td>
                <td><?php echo $item->upload_by; ?></td>
                <td><?php echo $item->reasons; ?></td>
                <td>
                    <a href="<?php echo base_url(); ?>index.php/graduate/get_upload_list/<?php echo $item->upload_id; ?> "
                       class="btn-sm btn-success">View Records Uploaded</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

</div>

