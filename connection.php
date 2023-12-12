<?php
$dsn = "mysql:host=localhost;dbname=brands";
$user = "root";
$pass = "";

try {
    $con = new PDO($dsn, $user, $pass);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $exception) {
    echo "Failed to connect" . $exception->getMessage();
}