<?php
session_start();
include('../database/condb.php');

// Query to fetch the latest sensor value, date, and calculate offline duration from the database
$sql = "SELECT d_val_1, d_date_in, TIMESTAMPDIFF(SECOND, d_date_in, NOW()) AS offline_duration FROM data_detail ORDER BY d_date_in DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Get the offline duration from the query result
    $offlineDuration = $row['offline_duration'];

    // Check if the offline duration is greater than 10 seconds
    if ($offlineDuration < 10) {
        echo 'Board Online';
    } else {
        // Format the offline duration for display
        $hours = floor($offlineDuration / 3600);
        $minutes = floor(($offlineDuration % 3600) / 60);
        $seconds = $offlineDuration % 60;
        echo 'Board Offline for ' . $hours . ' hours, ' . $minutes . ' minutes, ' . $seconds . ' seconds';
    }
}

// Close the database connection
$conn->close();
?>
