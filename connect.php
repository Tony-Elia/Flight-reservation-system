<?php

//     connect  to mysql
    $dsn = "mysql:host=localhost;dbname=reservation_system";
    $user = "root";
    $pass = "";
    $options = array(
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    );
    try {
        $conn = new PDO($dsn, $user, $pass, $options);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//        echo "Connected successfully!" . '<br/>';
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }



////
//$dsn = "sqlsrv:Server=DESKTOP-C8N2F0R;Database=reservation_system";
//$options = array(
//    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
//);
//try {
//    $conn = new PDO($dsn, "", "", $options);
//    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
////    echo "Connected successfully!";
//
//} catch (PDOException $e) {
//    echo "Connection failed: " . $e->getMessage();
//}
