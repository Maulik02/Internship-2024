<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "forms";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the total number of records
$sql = "SELECT COUNT(*) AS total FROM tbl_student";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$totalRecords = $row['total'];

// Get the data for DataTables
$start = $_GET['start'];
$length = $_GET['length'];

$sql = "SELECT s.*, c.name as country_name, st.name as state_name, ci.name as city_name 
        FROM tbl_student s
        LEFT JOIN countries c ON s.country_id = c.id
        LEFT JOIN states st ON s.state_id = st.id
        LEFT JOIN cities ci ON s.city_id = ci.id
        LIMIT $start, $length";

$result = $conn->query($sql);

// Prepare the data
$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = [
        $row["id"],
        $row["Name"],
        $row["Email"],
        date('d-m-Y', strtotime($row['Date_of_Birth'])),
        $row["country_name"],
        $row["state_name"],
        $row["city_name"],
        $row["Address"]
    ];
}

// Return JSON response
$response = [
    "draw" => intval($_GET['draw']),
    "recordsTotal" => $totalRecords,
    "recordsFiltered" => $totalRecords,
    "data" => $data
];

echo json_encode($response);
?>
