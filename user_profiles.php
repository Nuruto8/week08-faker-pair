<?php 
require 'vendor/autoload.php';
$faker = Faker\Factory::create('en_PH');

$host = "localhost";
$username = "root";
$password = "202280287PSU";
$database = "faker";

$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error){
    die("Connection failed" . $conn->connect_error);

}

for ($kb = 0; $kb < 5; $kb++){
    $full_name = $faker->name();
    $email = $faker->email();
    $phone_number = "+63 " . $faker->numerify("9## ### ####");
    $address = $faker->address();
    $birthdate = $faker->date('Y-m-d');
    $job_title = $faker->jobTitle();

    $stmt = $conn->prepare("INSERT INTO users (full_name, email, phone_number, address, birthdate, job_title) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $full_name, $email, $phone_number, $address, $birthdate, $job_title);
    $stmt->execute();
    $stmt->close();
}

$result = $conn->query("SELECT * FROM users ORDER BY id DESC LIMIT 5");

echo "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Fake User Profiles</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css' rel='stylesheet'>
</head>
<body class='container mt-4'>
    <h2>Fake User Profiles</h2>
    <table class='table table-bordered'>
        <tr>
            <th>ID</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Address</th>
            <th>Birthdate</th>
            <th>Job Title</th>
        </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['full_name']}</td>
                <td>{$row['email']}</td>
                <td>{$row['phone_number']}</td>
                <td>{$row['address']}</td>
                <td>{$row['birthdate']}</td>
                <td>{$row['job_title']}</td>
            </tr>";
        }

echo "</table></body></html>";

$conn->close();


?>