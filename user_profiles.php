<?php 
require 'vendor/autoload.php';
$faker = Faker\Factory::create('en_PH');

$host = "localhost";
$username = "root";
$password = "202280287PSU";
$database = "faker"

$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error){
    die("Connection failed" . $conn->connect_error);
}






?>