<?php 
    try {
        $host = "localhost";
        $dbname = "id21765951_studentrecorddb";
        $user = "id21765951_joshnoel123";
        $password = "Joshnoel123#";

        $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $err) {
        echo $err->getMessage();
    }
?>