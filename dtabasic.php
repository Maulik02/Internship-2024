<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "forms";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Table</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.bootstrap5.min.css">
</head>
<style>
    label {
        color:white;
        width: 60%;
        margin-top: 15px;
        margin-bottom: 10px;
        margin-right: 0px;
        margin-left: 943px;
    }
    div.dt-buttons{
        margin-top: 15px;
        width: 80%;
        margin-left: 150px;
        background-color: #32383e;
    }
    div.dataTables_wrapper div.dataTables_filter input {
        width: 40%;
    }
    body {
        background-color: #32383e;
    }
    .dataTables_info {
        color: white;
    }
    .pagination {
        margin-right: 20px;
    }
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
</style>
<body>
    <div>
    <table id="example" class="table table-striped table-dark">
        <thead>
            <tr class="col">
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
        <tbody>
            <?php
            $sql = 'SELECT s.*, c.name as country_name, st.name as state_name, ci.name as city_name FROM tbl_student s
                    LEFT JOIN countries c ON s.country_id = c.id
                    LEFT JOIN states st ON s.state_id = st.id
                    LEFT JOIN cities ci ON s.city_id = ci.id';

            // Fetch data from database
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>".$row["id"]."</td>
                            <td>".$row["Name"]."</td>
                            <td>".$row["Email"]."</td>
                            <td>".date('d-m-Y', strtotime($row['Date_of_Birth']))."</td>
                            <td>".$row["country_name"]."</td>
                            <td>".$row["state_name"]."</td>
                            <td>".$row["city_name"]."</td>
                            <td>".$row["Address"]."</td>
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='8'>No records found</td></tr>";
            }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Date of Birth</th>
                <th>Country</th>
                <th>State</th>
                <th>City</th>
                <th>Address</th>
            </tr>
        </tfoot>
    </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });
    </script>
</body>
</html>
