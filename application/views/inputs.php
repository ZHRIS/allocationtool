<div class="list-group">

    <a href="<?php echo site_url('worker_type/listAll'); ?>" class="list-group-item">
        <h4 class="list-group-item-heading">Worker Types</h4>

        <p class="list-group-item-text">Enter the different types of workers.</p>
    </a>

    <a href="<?php echo site_url('worker_level/listAll'); ?>" class="list-group-item">
        <h4 class="list-group-item-heading">Worker Levels</h4>

        <p class="list-group-item-text">Enter the different worker levels (for salaries purposes).</p>
    </a>

    <a href="<?php echo site_url('worker_salary/listAll'); ?>" class="list-group-item">
        <h4 class="list-group-item-heading">Worker Salary</h4>

        <p class="list-group-item-text">Enter default worker salaries for each combination of worker type and
            level.</p>
    </a>

    <a href="<?php echo site_url('location/listAll'); ?>" class="list-group-item">
        <h4 class="list-group-item-heading">Study locations</h4>

        <p class="list-group-item-text">Enter the different workers' study locations to compute
            distances to assigned work locations.</p>
    </a>

    <a href="<?php echo site_url('distance/listAll'); ?>" class="list-group-item">
        <h4 class="list-group-item-heading">Distance Lookup Table</h4>

        <p class="list-group-item-text">Enter the road distances for the different pairs between study
            and demand locations. If not entered, a default is computed.</p>
    </a>

    <a href="<?php echo site_url('setting/listAll'); ?>" class="list-group-item">
        <h4 class="list-group-item-heading">General Settings</h4>

        <p class="list-group-item-text">Input Setting and Optimization Settings. Input Settings regarding the data input that apply
            generally to all other input data (unless otherwise specified) and Optimization Settings regarding how long the model is allowed to run in GLPK.
        </p>
    </a>

</div>