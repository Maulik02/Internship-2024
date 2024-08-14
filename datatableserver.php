<!DOCTYPE html>
<html>
<head>
    <title>Server-side DataTable</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <style>
        .thead-table {
            background-color: #343a40;
            color: #fff;
        }
    </style>
</head>
<style>
    .dataTables_filter {
        margin-bottom: 10px;
    }
    a {
        margin-top: 8px;
    }
    .dataTables_info {
        margin-top: 10px;
        margin-left: 8px;
    }
    .dataTables_filter {
        margin-right: 7px;
    }
    .dataTables_length {
        margin-left: 8px;
    }
</style>
<body>
<table id="example" class="display">
    <thead>
        <tr class="thead-table">
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Date of Birth (day-month-year)</th>
            <th>Country</th>
            <th>State</th>
            <th>City</th>
            <th>Address</th>
        </tr>
    </thead>
    <tfoot>
        <tr class="thead-table">
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Date of Birth (day-month-year)</th>
            <th>Country</th>
            <th>State</th>
            <th>City</th>
            <th>Address</th>
        </tr>
    </tfoot>
</table>

<script>
$(document).ready(function() {
    $('#example').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "server_processing.php",
        "columns": [
            { "data": 0 },
            { "data": 1 },
            { "data": 2 },
            { "data": 3 },
            { "data": 4 },
            { "data": 5 },
            { "data": 6 },
            { "data": 7 }
        ]
    });
});

</script>

</body>
</html>
