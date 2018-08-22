<div class="row">
    <?php echo $this->breadcrumbs->show(); ?>
</div>

<div class="row">
    <script type="text/javascript">

        var demand_data = <?php echo json_encode($demand_data) ?>;

        $(function () {
            $("#output").pivotUI(demand_data);
        });

    </script>

    <div id="output" style="margin: 30px;"></div>
</div>