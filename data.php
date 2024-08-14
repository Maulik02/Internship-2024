<?php

$con = mysqli_connect("localhost","root","","forms");

$id = $_POST['id'];
$type = $_POST['type'];

if ($type == 'city') {
    $query = "SELECT * FROM cities WHERE state_id = '$id'";
} else {
    $query = "SELECT * FROM states WHERE country_id = '$id'";
}

$result = $con->query($query);

$options = '';

while ($row = $result->fetch_assoc()) {
    $options .= '<option value=" ' . $row['id'] . '">' . $row['name'] . '</option>';
}

echo $options;
