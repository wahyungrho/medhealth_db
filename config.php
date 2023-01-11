<?php

$host = "localhost";
$username = "root";
$password = "root";
$db_name = "medhealth";
$connection = mysqli_connect($host, $username, $password, $db_name);

if (!$connection) {
    # code...
    echo "Connection Failed";
}
