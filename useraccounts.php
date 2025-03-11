<?php
require 'vendor/autoload.php';


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize Faker
$faker = Faker\Factory::create();

function generateUUID() {
    return sprintf(
        '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        mt_rand(0, 0xffff), mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0x0fff) | 0x4000,
        mt_rand(0, 0x3fff) | 0x8000,
        mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
    );
}

// Insert fake users into database
for ($i = 0; $i < 10; $i++) {
    $uuid = generateUUID();
    $full_name = $faker->name;
    $email = $faker->unique()->safeEmail;
    $username = strtolower(explode('@', $email)[0]);
    $raw_password = $faker->password;
    $password_hash = hash('sha256', $raw_password);
    $account_created = $faker->dateTimeBetween('-2 years', 'now')->format('Y-m-d H:i:s');

    $sql = "INSERT INTO users (user_id, full_name, email, username, password_hash, account_created) 
            VALUES ('$uuid', '$full_name', '$email', '$username', '$password_hash', '$account_created')";

    $conn->query($sql);
}

// Fetch users from database
$result = $conn->query("SELECT * FROM users");

// Display in an HTML table
echo "<table border='1' cellpadding='5' cellspacing='0' style='border-collapse: collapse; width: 100%; text-align: left;'>";
echo "<tr><th>User ID</th><th>Full Name</th><th>Email</th><th>Username</th><th>Password (SHA-256)</th><th>Account Created</th></tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>{$row['user_id']}</td>";
    echo "<td>{$row['full_name']}</td>";
    echo "<td>{$row['email']}</td>";
    echo "<td>{$row['username']}</td>";
    echo "<td>{$row['password_hash']}</td>";
    echo "<td>{$row['account_created']}</td>";
    echo "</tr>";
}

echo "</table>";

// Close connection
$conn->close();
?>
