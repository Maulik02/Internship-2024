<?php
require_once 'vendor/autoload.php'; // Include Faker library

// Establish database connection
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

// Create Faker instance
$faker = Faker\Factory::create();

// Function to generate random date of birth between 18 to 40 years ago
function generate_dob() {
    $startDate = strtotime("-40 years");
    $endDate = strtotime("-18 years");
    $randomDate = mt_rand($startDate, $endDate);
    return date("Y-m-d", $randomDate);
}

// Generate and insert fake data into the table
for ($i = 0; $i < 10; $i++) { // Change the number as per your requirement
    $email = $faker->email;
    $password = $faker->password;
    $country_id = $faker->numberBetween(1, 100); // Assuming you have 100 countries in your database
    $state_id = $faker->numberBetween(1, 1000); // Assuming you have 1000 states in your database
    $city_id = $faker->numberBetween(1, 10000); // Assuming you have 10000 cities in your database
    $address = $faker->address;
    $date_of_birth = generate_dob();

    // SQL query to insert data into the table
    $sql = "INSERT INTO forms (email, password, country_id, state_id, city_id, address, date_of_birth)
            VALUES ('$email', '$password', '$country_id', '$state_id', '$city_id', '$address', '$date_of_birth')";

    if ($conn->query($sql) === TRUE) {
        echo "Record inserted successfully<br>";
    } else {
        echo "Error inserting record: " . $conn->error . "<br>";
    }
}

// Close connection
$conn->close();
?>