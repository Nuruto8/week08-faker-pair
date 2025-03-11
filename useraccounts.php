<?php
require 'vendor/autoload.php';
use Ramsey\Uuid\Uuid;

// Initialize Faker
$faker = Faker\Factory::create();
echo "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Fake User Accounts</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css' rel='stylesheet'>
    </head>
<body>
    <div class='container mt-4'>
        <h2 class='text-center'>Fake User Accounts</h2>
        <table class='table table-bordered text-center'>
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Username</th>
                    <th>Password (SHA-256)</th>
                    <th>Account Created</th>
                </tr>
            </thead>
            <tbody>";


for ($i = 1; $i <= 10; $i++) {
    $uuid = Uuid::uuid4()->toString(); 
    $full_name = $faker->name();
    $email = $faker->email();
    $username = explode('@', $email)[0]; 
    $password = hash('sha256', $faker->password());
    $account_created = $faker->dateTimeBetween('-2 years', 'now')->format('Y-m-d H:i:s');

    echo "<tr>
        <td>{$uuid}</td>
        <td>{$full_name}</td>
        <td>{$email}</td>
        <td>{$username}</td>
        <td>{$password}</td>
        <td>{$account_created}</td>
    </tr>";
}

echo "        </tbody>
        </table>
    </div>
</body>
</html>";

?>
