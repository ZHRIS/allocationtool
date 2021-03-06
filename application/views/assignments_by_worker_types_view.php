<div class="row">
    <?php echo $this->breadcrumbs->show(); ?>
</div>
<?php $total_demand = 0; ?>
<?php $total_number_of_workers = 0; ?>
<?php $total_number_of_workers_assigned = 0; ?>
<div class="row">
    <caption><h4> Assignments by Worker Types </h4></caption>
    <table id="etable" class="table table-striped table-hover">
        <thead>
        <tr>
            <th> Worker Type</th>
            <th> Demand</th>
            <th> Number of Workers</th>
            <th> Worker Assigned</th>
            <th> Workers Not Assigned</th>
            <th> Worker Deficit</th>
            <th> Worker Surplus</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($assignments_by_worker_types as $item): ?>
            <?php $total_demand = $item->Requested + $total_demand; ?>
            <?php $total_number_of_workers = $item->TotalWorkers + $total_number_of_workers; ?>
            <?php $total_number_of_workers_assigned = $item->Assigned + $total_number_of_workers_assigned; ?>
            <tr>
                <td><?php echo $item->WorkerType; ?></td>
                <td><?php echo $item->Requested; ?></td>
                <td><?php echo $item->TotalWorkers; ?></td>
                <td><?php echo $item->Assigned; ?></td>
                <td><?php echo($item->TotalWorkers - $item->Assigned); ?></td>
                <td><?php
                        if( ($item->Requested - $item->TotalWorkers) < 0) {
                            echo((($item->Requested - $item->TotalWorkers) * -1));
                        }else{
                            echo(($item->Requested - $item->TotalWorkers));
                       }
                    ?></td>
                <td><?php

                    if ($item->Requested > $item->TotalWorkers)
                        echo(0);
                    else
                        echo($item->TotalWorkers - $item->Requested);

                    ?></td>
            </tr>
        <?php endforeach; ?>
        <tfoot>
        <tr>
            <th>Total</th>
            <th> <?php echo $total_demand; ?></th>
            <th> <?php echo $total_number_of_workers; ?> </th>
            <th> <?php echo $total_number_of_workers_assigned; ?> </th>
            <th> <?php echo($total_number_of_workers - $total_number_of_workers_assigned); ?></th>
            <th> <?php echo($total_demand - $total_number_of_workers_assigned); ?> </th>
            <th> <?php echo($total_number_of_workers - $total_number_of_workers_assigned); ?></th>
        </tr>
        </tfoot>
        </tbody>
    </table>
</div>
