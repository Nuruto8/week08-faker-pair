<?php 
require 'vendor/autoload.php';
$faker = Faker\Factory::create('en_PH');




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

        for ($kb = 1; $kb < 6; $kb++){
            echo"<tr>
            <td>{$kb}</td>
            <td>{$faker->name()}</td>
            <td>{$faker->email()}</td>
            <td>+63 {$faker->numerify('9## ### ####')}</td>
            <td>{$faker->address()}</td>
            <td>{$faker->date('Y-m-d')}</td>
            <td>{$faker->jobTitle()}</td>
                </tr>";
             }

echo "</table></body></html>";




?>