<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'chloe');
define('DB_PASS', '123456');
define('DB_NAME', 'php');

//create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// check connection
if ($conn->connect_error) {
    die('エラー' . $conn->connect_error);
}

// echo 'connected';