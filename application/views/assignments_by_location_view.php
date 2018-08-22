<div class="row">
    <?php echo $this->breadcrumbs->show(); ?>
</div>
<?php $total_allocated_workers = 0; ?>
<?php $total_requested_workers = 0 ?>
<?php $total_workers_assigned_to_top_preference = 0 ?>
<?php $total_workers_assigned_to_top_three_preference = 0 ?>
<?php $total_demand_location_budget = 0 ?>
<?php $total_allocation_budget = $this->setting_model->get_total_demand_locations_budget() ;?>
<div class="row">
    <table id="etable" class="table table-striped table-hover">
        <caption><h4>Assignments by Location</h4></caption>
        <thead>
        <tr>
            <th> Demand Location</th>
            <th> Workers Assigned</th>
            <th> Workers Requested</th>
            <th> % Assigned vs. Total Num. of Workers</th>
            <th> Workers Assigned to Top Preference</th>
            <th> % Workers Assigned to Top Preference</th>
            <th> Workers Assigned to Top 3 Preferences</th>
            <th> % Workers Assigned to Top 3 Preferences</th>
            <th> Allocated Budget</th>
            <th> % Allocated of Total Budget</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($assigments_by_location as $item): ?>
            <?php $total_allocated_workers = $item->Assigned + $total_allocated_workers; ?>
            <?php $total_requested_workers = $item->Requested + $total_requested_workers; ?>
            <?php $total_workers_assigned_to_top_preference = $item->TopPreference + $total_workers_assigned_to_top_preference; ?>
            <?php $total_workers_assigned_to_top_three_preference = $item->AssignedTopThreePreference + $total_workers_assigned_to_top_three_preference; ?>
            <?php $total_demand_location_budget = $item->Bugdet + $total_demand_location_budget; ?>
            <tr>
                <td><?php echo $item->DemandLocation; ?></td>
                <td><?php echo $item->Assigned; ?></td>
                <td><?php echo $item->Requested; ?></td>
                <td><?php echo get_percentage($item->TotalWorkers, $item->Assigned) . '%' ?></td>
                <td><?php echo $item->TopPreference; ?></td>
                <td> <?php echo get_percentage($item->TotalWorkers, $item->TopPreference) . '%' ?></td>
                <td><?php echo $item->AssignedTopThreePreference; ?></td>
                <td><?php echo get_percentage($item->TotalWorkers, $item->AssignedTopThreePreference) . '%' ?></td>
                <th><?php echo $item->Bugdet; ?></th>
                <td><?php echo get_percentage($total_allocation_budget, $item->Bugdet) . '%' ?></td>
            </tr>
        <?php endforeach; ?>
        <tfoot>
        <tr>
            <th>Total</th>
            <th title="Total Assigned"> <?php echo $total_allocated_workers; ?></th>
            <th title="Total number of Requested Workers">  <?php echo $total_requested_workers; ?> </th>
            <th title="% Assigned vs. Total Num. of Workers"> <?php echo get_percentage($total_requested_workers, $total_allocated_workers) . '%'; ?></th>
            <th title="Workers Assigned to Top Preferences"> <?php echo $total_workers_assigned_to_top_preference; ?></th>
            <th title="% Workers Assigned to Top Preferences"> <?php echo get_percentage($total_requested_workers,
                    $total_workers_assigned_to_top_preference); ?>
            </th>
            <th title="Workers Assigned to Top 3 Preferences"> <?php echo $total_workers_assigned_to_top_three_preference; ?>
            </th>
            <th title="% Workers Assigned to Top 3 Preferences"> <?php echo get_percentage($total_requested_workers,
                        $total_workers_assigned_to_top_three_preference) . ' %'; ?>
            </th>
            <th title="Total Bugget"> <?php echo $total_demand_location_budget; ?></th>
            <th title="% Total Budget"> <?php echo get_percentage($total_allocation_budget, $total_demand_location_budget) . '%'; ?>
            </th>
        </tr>
        </tfoot>
        </tbody>
    </table>
</div>

