$(function () {

    $('#emp_table').DataTable({
        "paging": true,
        searching: true,
        buttons: [
            'print', 'copy', 'excel', 'pdf'
                    , {
                        extend: 'colvis',
                        postfixButtons: ['colvisRestore'],

                    }
        ]
    });

    $('#tableList').dataTable({"aaSorting": []});

    var table = $('#etable').DataTable({
        scrollY: "800px",
        scrollX: true,
        scrollCollapse: true,
        paging: true,
        fixedColumns: {
            leftColumns: 2
        },
        dom: 'Bfrtip',
        buttons: [
            'print', 'copy', 'excel', 'pdf'
                    , {
                        extend: 'colvis',
                        postfixButtons: ['colvisRestore'],

                    }
        ]
    });

    var table = $('#demand_met_by_location').DataTable({
        scrollY: true,
        scrollX: true,
        scrollCollapse: true,
        paging: true,
        fixedColumns: {
            leftColumns: 2,
            rightColumns: 1
        },
        dom: 'Bfrtip',
        buttons: [
            'print', 'copy', 'excel', 'pdf'
                    , {
                        extend: 'colvis',
                        postfixButtons: ['colvisRestore'],

                    }
        ]
    });

    $('a.toggle-vis').on('click', function (e) {
        e.preventDefault();

        // Get the column API object
        var column = table.column($(this).attr('data-column'));

        // Toggle the visibility
        column.visible(!column.visible());
    });

});

function activeTab(tab) {
    $('.nav-tabs a[href="#' + tab + '"]').tab('show');
}
;

var delete_message = 'Are You Sure to Delete this Record?';

function save_worker() {
    $("graduateform#submit").click(function () {
        $("#loading").show();
        var graduate_no = $("#graduate_no").val();
        var first_name = $("#first_name").val();
        var last_name = $("#last_name").val();
        var location_id = $("#location_id").val();
        var worker_type_id = $("#worker_type_id").val();
        var worker_level_id = $("#worker_level_id").val();
        var gender = $("#gender").val();

        $.post($base_url + "graduate/index", {
            graduate_no: graduate_no,
            first_name: first_name,
            last_name: last_name
            ,
            location_id: location_id,
            worker_type_id: worker_type_id,
            worker_level_id: worker_level_id,
            gender: gender
        },
                function (status) {
                    $("#loading").hide();
                    if (status == 'Form Submitted Successfully....') {
                        $("#graduate_no").val('');
                        $("#first_name").val('');
                        $("#last_name").val('');
                        $("#location_id").val('');
                        $("#worker_level_id").val('');
                        $("#worker_type_id").val('');
                        $("#gender").val('');
                    }
                    alert(status);
                });
    });
}

function delete_location(id) {

    if (confirm(delete_message)) {
        window.location.href = base_url + 'index.php/location/delete/' + id;
    }
}

function delete_graduate(id) {

    if (confirm(delete_message)) {
        window.location.href = base_url + 'index.php/graduate/delete/' + id;
    }
}

function delete_user(id) {

    if (confirm(delete_message)) {
        window.location.href = base_url + 'index.php/user/delete/' + id;
    }
}

function delete_worker_type(id) {

    if (confirm(delete_message)) {
        window.location.href = base_url + 'index.php/worker_type/delete/' + id;
    }
}

function delete_worker_level(id) {

    if (confirm(delete_message)) {
        window.location.href = base_url + 'index.php/worker_level/delete/' + id;
    }
}

function delete_worker_salary(id) {

    if (confirm(delete_message)) {
        window.location.href = base_url + 'index.php/worker_salary/delete/' + id;
    }
}

function delete_setting(id) {

    if (confirm(delete_message)) {
        window.location.href = base_url + 'index.php/setting/delete/' + id;
    }
}

function delete_distance(id) {

    if (confirm(delete_message)) {
        window.location.href = base_url + 'index.php/distance/delete/' + id;
    }
}

function delete_demand_location(id) {

    if (confirm(delete_message)) {
        window.location.href = base_url + 'index.php/demand_location/delete/' + id;
    }
}

function delete_preference(id) {

    if (confirm(delete_message)) {
        window.location.href = base_url + 'index.php/graduate/delete_preference/' + id;
    }
}

function logout() {
    var msg = 'Are you sure you want to logout of the system ?';
    if (confirm(msg)) {
        window.location.href = base_url + 'index.php/login/logout';
    }
}

function configure_system() {
    window.location.href = base_url + 'index.php/setting/configure_system';
}

function change_password() {
    window.location.href = base_url + 'index.php/user/change_password';
}

function run_glpk_csv() {
    document.getElementById('processing_div').style.display = 'block'
}

function reset_app_data() {
    var delete_message = 'Are You Sure You Want to Reset System?';
    if (confirm(delete_message)) {
        window.location.href = base_url + 'index.php/setting/delete_allocation_tool_data';
    }
}

function reset_worker_data() {
    var delete_message = 'Are You Sure You Want to Reset Worker input data System?';
    if (confirm(delete_message)) {
        window.location.href = base_url + 'index.php/setting/delete_worker_data';
    }
}




