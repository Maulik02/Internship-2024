<?php
include_once 'vendor/autoload.php';
$con = mysqli_connect('localhost', 'root', '', 'forms');

// Prepare the INSERT statement outside the loop
$query = "INSERT INTO tbl_student (name, date_of_birth, email, country_id, state_id, city_id, address) 
          VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($con, $query);

if (!$stmt) {
    die("Error: " . mysqli_error($con));
}

for ($i = 0; $i <= 1000; $i++) {
    $faker = Faker\Factory::create();
    $name = $faker->name();
    $email = $faker->email();

    $country_id_query = "SELECT id FROM countries ORDER BY RAND() LIMIT 1";
    $country_id_result = mysqli_query($con, $country_id_query);
    $country_id_row = $country_id_result->fetch_assoc();
    $country_id = $country_id_row['id'];

    $state_id_query = "SELECT id FROM states WHERE country_id = '$country_id' ORDER BY RAND() LIMIT 1";
    $state_id_result = mysqli_query($con, $state_id_query);
    $state_id_row = $state_id_result->fetch_assoc();
    $state_id = $state_id_row['id'];

    $city_id_query = "SELECT id FROM cities WHERE state_id = '$state_id' ORDER BY RAND() LIMIT 1";
    $city_id_result = mysqli_query($con, $city_id_query);
    $city_id_row = $city_id_result->fetch_assoc();
    $city_id = $city_id_row['id'];

    $address = $faker->address();

    $datetostr = new DateTime($faker->date());
    $date = $datetostr->getTimestamp();

    // Bind parameters to the statement
    mysqli_stmt_bind_param($stmt, "sssiiss", $name, $date, $email, $country_id, $state_id, $city_id, $address);

    // Execute the statement
    if (mysqli_stmt_execute($stmt)) {
        echo "Data inserted successfully<br>";
    } else {
        echo "Data not inserted<br>";
    }
}
?>
