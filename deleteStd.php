<?php 
include "./conn.php";
header("Content-Type:application/json");
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $stdId = $_POST["id"];

    $connect = new ConnectDatabase();
    $connect->deleteStudent($stdId);
    }

?>