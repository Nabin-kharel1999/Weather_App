
<div class="weatherHistory">
      <h2 class="font">Weather History</h2>

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
        echo '<div class="weather-history">';

        while ($row = $result->fetch_assoc()) {
          echo '<div class="weather-ins">';
          echo '<div class="weather-description">' . $row['description'] . '</div>'; // Displaying weather description
          echo '<div class="temperature">' . $row['temperature'] . '°C</div>';
          echo '<div class="weather-day">' . $row['fetchdate'] . '<br></div>';


          echo '</div>';


        }
        echo '</div>';
      } else {
        echo "No weather data available.";
      }


      $conn->close();
      ?>
    </div>
