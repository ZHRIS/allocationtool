<div class="list-group">


    <a href="<?php echo base_url(); ?>index.php/allocation/worker_assignments_view" class="list-group-item"
       title="Results of the assignments for all HCWs. We also include important data for each of the HCW.">
        <h4 class="list-group-item-heading">Worker Assignments</h4>

        <p class="list-group-item-text">Shows the budget and positions assigned through fixed assignment in "Worker
            Settings".
            Computes the distance between locations. <i class="glyphicon glyphicon-info-sign"></i>
        </p>


    </a>

    <a href="<?php echo base_url(); ?>index.php/allocation/demand_met_by_location_view" class="list-group-item"
       title="Show the results for the demand fulfillment for each location and worker type.">
        <h4 class="list-group-item-heading">Demand Met by Location</h4>

        <p class="list-group-item-text">Show the percentage of demand met (by type of cadre) by location.

            <i class="glyphicon glyphicon-info-sign"></i>
        </p>
    </a>

    <a href="<?php echo base_url(); ?>index.php/allocation/assignments_by_location_view" class="list-group-item"
       title="Show the results for the demand fulfillment for each location and worker type.">
        <h4 class="list-group-item-heading">Assignments by Location</h4>

        <p class="list-group-item-text">Shows the number of workers assigned by location, workers assigned to top and
            top 3 preferences,
            used budget, average distance to workers' study locations.
            <i class="glyphicon glyphicon-info-sign"></i>
        </p>
    </a>


    <a href="<?php echo base_url(); ?>index.php/allocation/assignments_by_worker_types_view" class="list-group-item"
       title="Statistics of the assignment results for each worker type (and overall for all worker types at the top). This worksheet can help to compare the total demand for each worker type,
                with the available number of workers of that type. They can help the user to adjust demand data if necessary.">
        <h4 class="list-group-item-heading">Assignments by Worker Types</h4>

        <p class="list-group-item-text">Shows the number of workers demanded by type, how many are demanded, and how
            many were assigned.
            <i class="glyphicon glyphicon-info-sign"></i>
        </p>
    </a>


    <a href="<?php echo base_url(); ?>index.php/allocation/preferences_by_location_view" class="list-group-item"
       title=" Shows how popular are the demand locations in terms of how many times the HCWs selected them as a top or top three preference.">
        <h4 class="list-group-item-heading">Preferences by Location</h4>

        <p class="list-group-item-text">Shows how many times a location was selected in the preferences as top or top 3
            preference (measures popularity of the demand location).
            <i class="glyphicon glyphicon-info-sign"></i>

        </p>
    </a>

    <a href="<?php echo base_url(); ?>index.php/allocation/fixed_assignments_view" class="list-group-item"
       title="Summarize the HCWs fixed assignments by location and worker type, to make sure they do not violate budget or demand constraints.">
        <h4 class="list-group-item-heading">Fixed Assignments</h4>

        <p class="list-group-item-text">Shows the budget and fixed assignments

            <i class="glyphicon glyphicon-info-sign"></i>
        </p>
    </a>

</div>