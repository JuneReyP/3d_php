<?php
try {
    $host = "localhost";
    $myDB = "3d_php";
    $u_name = "root";
    $password = "";

    $conn = new PDO("mysql:host=$host;dbname=$myDB", $u_name, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // if($conn){
    //     echo "database connected!";
    // }
} catch (PDOException $err) {
    echo $err->getMessage();
}
?>