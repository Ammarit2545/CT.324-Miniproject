<?php
session_start();
include('../database/condb.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST' || isset($_GET['sensor_value1']) || isset($_GET['sensor_value2'])) {
    $sensorValue1 = isset($_POST['sensor_value1']) ? $_POST['sensor_value1'] : $_GET['sensor_value1'];
    $sensorValue2 = isset($_POST['sensor_value2']) ? $_POST['sensor_value2'] : $_GET['sensor_value2'];


    echo "Received Sensor Value: " . $sensorValue;
    $sql = "INSERT INTO data_detail (board_id,d_val_1, d_date_in) VALUES ('1', '$sensorValue1', NOW()) ";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $_SESSION['val_1'] = 0;
        
    } else {
        $_SESSION['val_1'] = 0;
    }
} else {
    echo "Invalid request method.";
    $_SESSION['val_1'] = 0;
}
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
