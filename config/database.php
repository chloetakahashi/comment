<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'bychngiz_php-feedback-user');
define('DB_PASS', 'vurtH7X7jawSDVp');
define('DB_NAME', 'bychngiz_php-feedback');

//create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// check connection
if ($conn->connect_error) {
    die('エラー' . $conn->connect_error);
}

// echo 'connected';
