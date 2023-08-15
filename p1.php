


<?php
date_default_timezone_set('Asia/Kathmandu');

$mysqli = new mysqli('localhost', 'root', '');

// Creating Database prototype2_Portsmouth to store the api data in my database
$dbCreating = 'CREATE DATABASE IF NOT EXISTS prototype2_Portsmouth';
$dbCreated = $mysqli->query($dbCreating);

// if ($dbCreated) {
//     echo "<script> alert ('Successfully created database') </script>";
// } else {
//     echo "<script> alert ('Database creation failed: " . $mysqli->error . "') </script>";
// }

// Selecting the database
$dbSelecting = $mysqli->select_db('prototype2_Portsmouth');
// if (!$dbSelecting) {
//     echo "<script> alert ('Failed to select database: " . $mysqli->error . "') </script>";
// }

// Creating a table to append the weather data from open weather map server API
$tableCreating = 'CREATE TABLE IF NOT EXISTS Portsmouth (
    city VARCHAR(50) NOT NULL,
    temperature FLOAT NOT NULL,
    wind FLOAT NOT NULL,
    Direction FLOAT NOT NULL,
    humidity FLOAT NOT NULL,
    pressure FLOAT NOT NULL,
    description VARCHAR(250) NOT NULL,
    fetchdate DATETIME NOT NULL
)';
$tableCreated = $mysqli->query($tableCreating);
// if ($mysqli->query($tableCreating)) {
//     echo " <script> alert ('Table created successfully') </script>";
// } else {
//     echo " <script> alert ('Table creation failed: " . $mysqli->error . "') </script>";
// }

$dataSelecting = "SELECT * FROM Portsmouth
    WHERE fetchdate >= Date_SUB(NOW(), INTERVAL 1 MINUTE)
    ORDER BY fetchdate DESC LIMIT 1
";
$result = $mysqli->query($dataSelecting);

if ($result->num_rows === 0) {
    // Calling the Open Weather Map API and appending the data in our database...
    $jsonFile = file_get_contents('https://api.openweathermap.org/data/2.5/weather?q=Portsmouth&units=metric&appid=3d11bae6e1b68c371c98d8a85cd848b8');
    $php_objects = json_decode($jsonFile);

    // Declaring variables to insert data in table
    $city = $php_objects->name;
    $temperature = $php_objects->main->temp;
    $humidity = $php_objects->main->humidity;
    $wind = $php_objects->wind->speed;
    $Direction = $php_objects->wind->deg;
    $pressure = $php_objects->main->pressure;
    $description = $php_objects->weather[0]->description;
    $todaysDate = date("Y-m-d H:i:s");

    // Inserting data into the table
    $dataInserting = "INSERT INTO Portsmouth
        (city,temperature,humidity,wind,Direction,pressure,description,fetchdate)
        VALUES
        ('$city',$temperature,$humidity,$wind,$Direction,$pressure,'$description','$todaysDate')";
    
    $insertDataQuery = $mysqli->query($dataInserting);

    // This query deletes old data from the table when new data is inserted
    // if ($insertDataQuery) {
    //     $delOldData = "DELETE FROM Portsmouth WHERE fetchdate < Date_SUB(NOW(), INTERVAL 1 HOUR)";
    //     $deletData = $mysqli->query($delOldData);
    // }
}
?>
