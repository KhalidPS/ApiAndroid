<?php 
    include "./conn.php";
    header("Content-Type:application/json");
    
    $conncet = new ConnectDatabase();

    if($_SERVER['REQUEST_METHOD'] == "GET"){
        $conncet->showStudent();
    }
    
?>