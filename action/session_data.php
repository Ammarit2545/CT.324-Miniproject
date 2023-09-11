<?php
session_start();

if (isset($_SESSION['value_1'])) {
    echo $_SESSION['value_1'];
} else {
    echo 'Session value not set';
}
?>
