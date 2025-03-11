<?php
require 'vendor/autoload.php';

$faker = Faker\Factory::create();

$genres = ['Fiction', 'Mystery', 'Science Fiction', 'Fantasy', 'Romance', 'Thriller', 'Historical', 'Horror'];

// Generate fake book records
$books = [];
for ($i = 0; $i < 15; $i++) {
    $books[] = [
        'title' => $faker->sentence(3),
        'author' => $faker->name,
        'genre' => $faker->randomElement($genres),
        'publication_year' => $faker->year,
        'isbn' => $faker->isbn13,
        'summary' => $faker->paragraph(2)
    ];
}

// Display records in an HTML table
echo "<table border='1' cellpadding='5' cellspacing='0' style='border-collapse: collapse; width: 100%; text-align: left;'>";
echo "<tr><th>Title</th><th>Author</th><th>Genre</th><th>Publication Year</th><th>ISBN</th><th>Summary</th></tr>";
foreach ($books as $book) {
    echo "<tr>";
    echo "<td>{$book['title']}</td>";
    echo "<td>{$book['author']}</td>";
    echo "<td>{$book['genre']}</td>";
    echo "<td>{$book['publication_year']}</td>";
    echo "<td>{$book['isbn']}</td>";
    echo "<td>{$book['summary']}</td>";
    echo "</tr>";
}
echo "</table>";
