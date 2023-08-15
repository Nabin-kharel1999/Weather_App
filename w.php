<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather App</title>
    <link rel="stylesheet" href="w.css">
    <script src="w.js"></script>
</head>
<body>
    <div class="boxed">
        <h3 id="black">
            <div id="current_date" align="center"></div>
        </h3>
        <hr>
        <div class="search">
            <input type="text" class="search-bar" placeholder="Search bar does not work">
            <button>CLICK</button>
        </div>
        <hr>
        <div>
            <h1 class="cityName" id="black"></h1>
            <h1 class="temperature" id="black"></h1>
            <img src="" alt="" class="icon"/>
            <div class="description" id="black"></div>
            <div class="humidity" id="black"></div>
            <div class="wind" id="black"></div>
            <div class="Direction" id="black"></div>
            <div class="pressure" id="black"></div>
        </div>
        <hr>
    </div>
    <div class="weatherHistory">
        <h2 class="font">Seven Day Weather History of Portsmouth</h2>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "prototype2_portsmouth";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM portsmouth ORDER BY fetchdate DESC LIMIT 7";
        $result = $conn->query($sql);

        if ($result === false) {
            // Query execution failed
            echo "Error executing query: " . $conn->error;
        } elseif ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="weather-ins">';
                echo '<div class="weather-card">';
                echo '<div class="weather-description">' . $row['description'] . '</div>';
                echo '<div class="temperature">' . $row['temperature'] . '°C</div>';
                echo '<div class="weather-day">' . $row['fetchdate'] . '<br></div>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo "No weather data available.";
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
