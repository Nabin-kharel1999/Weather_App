<?php
include('p1.php');
$selectingData = "SELECT * FROM Portsmouth
ORDER BY fetchdate DESC LIMIT 1
";
$result = $mysqli->query($selectingData);
$rowDataArray = $result ->fetch_assoc();
$jsonFile = json_encode($rowDataArray);
echo $jsonFile;
?>