<?php
    $dsn = 'mysql:dbname=xxx;host=localhost';
    $user = 'xxx';
    $password = 'xxx';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
?>