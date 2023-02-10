<?php 
    $host = "localhost";
    $user = "root";
    $dbname = "techstore";
    $password = "";

    $dsn = "mysql:host=" . $host . ";dbname=" . $dbname;

    $pdo = new PDO($dsn, $user, $password);
?>
