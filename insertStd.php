<?php

    include "./conn.php";
    header("Content-Type:application/json");

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $id = $_POST['id'];
        $name = $_POST['name'];
        $gpa = $_POST['gpa'];
        $img = $_POST['img'];


        $currentMiiles = floor(microtime(true) * 1000);
        $fileName = "C:/xampp/htdocs/web/ApiAndroid/storage/img$currentMiiles.txt";
        $myFile = fopen($fileName,"w");
        fwrite($myFile,$img);
        fclose($myFile);


        $connect = new ConnectDatabase();
        $connect->addStudent($id,$name,$gpa,$fileName);
        
    
      
        


    }

   
?>