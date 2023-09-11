<?php
session_start();
include('../database/condb.php');

// Query to fetch the latest sensor value, date, and calculate offline duration from the database
$sql = "SELECT d_val_1, d_date_in, TIMESTAMPDIFF(SECOND, d_date_in, NOW()) AS offline_duration FROM data_detail ORDER BY d_date_in DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo $row['d_date_in'];
}

// Close the database connection
$conn->close();
?>
