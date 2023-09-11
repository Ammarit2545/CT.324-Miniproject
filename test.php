<!DOCTYPE html>
<html>
<head>
    <title>Real-time Session Value Update</title>
</head>
<body>
    <div id="valueContainer">Session Value: <span id="sessionValue"><?php echo $_SESSION['value_1']; ?></span></div>

    <script>
        // Function to update the session value on the page
        function updateSessionValue() {
            var sessionValueElement = document.getElementById('sessionValue');
            var xhr = new XMLHttpRequest();

            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    sessionValueElement.textContent = xhr.responseText;
                }
            };

            xhr.open('GET', 'action/session_data.php', true);
            xhr.send();
        }

        // Update the session value initially
        updateSessionValue();

        // Periodically update the session value (every 5 seconds in this example)
        setInterval(updateSessionValue, 5000);
    </script>
</body>
</html>
