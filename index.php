<?php
session_start();

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CT.324 - Looking Page</title>
    <!-- Add Bootstrap CSS (CDN or local) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 50px;
        }

        .card {
            border: 1px solid #ccc;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            padding: 20px;
            text-align: center;
        }

        #sensorValueLive,
        .value {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 20px;
            display: inline;
        }

        .date {
            font-size: 18px;
            color: #888;
            display: inline;
        }

        #sensorValueLiveDate,
        #sensorValueLive {
            display: inline;
        }

        .active {
            display: inline;
        }

        /* Add these styles to your existing CSS */
        .dot-container {
            display: inline-flex;
            /* Display children in a row */
            align-items: center;
            /* Center vertically within the container */
            gap: 10px;
            /* Space between the dot and date */
        }

        .dot {
            width: 20px;
            height: 20px;
            background-color: green;
            border-radius: 50%;
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
        }

        /* Add these styles to your existing CSS */
        .reddot-container {
            display: inline-flex;
            /* Display children in a row */
            align-items: center;
            /* Center vertically within the container */
            gap: 10px;
            /* Space between the dot and date */
        }

        .reddot {
            width: 20px;
            height: 20px;
            background-color: red;
            border-radius: 50%;
            opacity: 1;
            transition: opacity 0.5s ease-in-out;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3 text-center">
                <div class="card">
                    <h2 class="value">Sensor Value : <p id="sensorValueLive"></p> Lumen</h2>

                    <!-- Wrap dot and date in a container div -->
                    <center>
                        <div class="dot-container">
                            <div class="dot" id="greenDot"></div>
                            <div class="date">Online : <p id="sensorValueLiveDate"></p>
                            </div>
                        </div>
                    </center>

                    <center>
                        <div class="dot-container">
                            <div class="reddot" style=" display: inline;"></div>
                            <div class="date" style=" display: inline;">Offline : asdasddas</p>
                            </div>
                        </div>
                    </center>

                    <p id="valueDisplay"></p>
                </div>
            </div>
        </div>
    </div>


    <script>
        function updateSensorValue() {
            fetch('http://192.168.7.128/ct324_miniproject/action/send_value.php')
                .then(response => response.text())
                .then(data => {
                    document.getElementById('sensorValueLive').textContent = data;
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                });
        }

        // Update the sensor value every 5 seconds
        setInterval(updateSensorValue, 1000);
        updateSensorValue(); // Initial update

        function sensorValueLiveDate() {
            fetch('http://192.168.7.128/ct324_miniproject/action/get_session_value.php')
                .then(response => response.text())
                .then(data => {
                    document.getElementById('sensorValueLiveDate').textContent = data;
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                });
        }

        // Update the sensor value every 5 seconds
        setInterval(sensorValueLiveDate, 1000);
        sensorValueLiveDate(); // Initial update

        // Function to update the displayed value
        function updateValue() {
            // Make an AJAX request to fetch the updated value from the server
            fetch('action/get_updated_value.php')
                .then(response => response.text())
                .then(data => {
                    // Update the value in the HTML
                    document.getElementById('valueDisplay').textContent = data;
                });
        }

        // Update the value every 1 second
        setInterval(updateValue, 1000);

        document.addEventListener("DOMContentLoaded", function() {
            const greenDot = document.getElementById("greenDot");

            function fadeInDot() {
                greenDot.style.opacity = "1";
            }

            function fadeOutDot() {
                greenDot.style.opacity = "0";
            }

            // Show the dot for 1 second, then hide it for 1 second, and repeat
            setInterval(() => {
                fadeInDot();
                setTimeout(fadeOutDot, 1000);
            }, 2000); // Change the time interval as needed
        });
    </script>
    <!-- Bootstrap JS and jQuery (optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Add Bootstrap JavaScript (CDN or local) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>