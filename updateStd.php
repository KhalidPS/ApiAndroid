<?php
 include "./conn.php";
 header("Content-Type:application/json");

 if($_SERVER['REQUEST_METHOD'] == "POST"){

    $stdId = $_POST['stdId'];
    $name = $_POST['name'];
    $gpa = $_POST['gpa'];
    $img = $_POST['img'];
 
 $connect = new ConnectDatabase();
 $connect->updateStudent($stdId,$name,$gpa,$img);
}
?>