<?php
$username = "root";
$password = "123";

$conn = new PDO("mysql:host=localhost;dbname=test", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);