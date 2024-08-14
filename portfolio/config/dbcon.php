<?php

$host="localhost";
$user="root";
$passwprd="";
$database= "portfolio";

$conn = mysqli_connect($host, $user, $passwprd, $database);

if (!$conn) {
    die("Connection failed...". mysqli_connect_error());
}

?>