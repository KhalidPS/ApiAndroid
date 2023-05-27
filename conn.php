<?php 

class ConnectDatabase{
    private $conn;

    function __construct(){
        $this->conn = new mysqli("localhost","root","","students");

if($this->conn->connect_error){
    echo $this->conn->connect_error;
}else{
    return $this->conn;
}
    }

    ////////////////////////////////////////////////////////////////////////////////////////////


    function addStudent($id,$name,$gpa,$fileName){
        $insertStudentQuery = "INSERT INTO students (stdId,name,gpa,img) values ($id,'$name',$gpa,'$fileName');";
        $this->conn->query($insertStudentQuery);
    }

    ////////////////////////////////////////////////////////////////////////////////////////////


    function deleteStudent($id){
        $selectImgDir = "SELECT img FROM students WHERE stdId = $id;";
        $fileName =  $this->conn->query($selectImgDir)->fetch_assoc()['img'];
        if(file_exists($fileName)){
            unlink($fileName);
        }

        $deleteQuery = "DELETE FROM students WHERE stdId = $id;";
        $this->conn->query($deleteQuery);
    }

////////////////////////////////////////////////////////////////////////////////////////////

    function showStudent(){
        $arrayStd = array();
        $SelectAllStudents = "SELECT * FROM students;";
        $result = $this->conn->query($SelectAllStudents);
        if($result->num_rows > 0){


            while($row = $result->fetch_assoc()){
                $stdId = $row['stdId'];
                $name = $row['name'];
                $gpa = $row['gpa'];
                $imgDir = $row['img'];

                $myfile = fopen("$imgDir","r");
                $fullImg =  fread($myfile,filesize("$imgDir"));
                fclose($myfile);

                $array = array("stdId"=>$stdId,"name"=>$name,"gpa"=>$gpa,"img"=>$fullImg);

                array_push($arrayStd,$array);
            }
            echo json_encode($arrayStd);
        }

    }

    ////////////////////////////////////////////////////////////////////////////////////////////

    function updateStudent($stdId,$name,$gpa,$img){

        $GetOldImgQuery = "SELECT img FROM students WHERE stdId = $stdId;";
        $oldImg = $this->conn->query($GetOldImgQuery)->fetch_assoc()['img'];
        if(file_exists($oldImg)){
            unlink($oldImg);
        }

        $currentMiiles = floor(microtime(true) * 1000);
        $fileName = "C:/xampp/htdocs/web/ApiAndroid/storage/img$currentMiiles.txt";
        $myFile = fopen($fileName,"w");
        fwrite($myFile,$img);
        fclose($myFile);
   
        $UpdateQuerey = "UPDATE students SET gpa = $gpa , name = '$name' , img = '$fileName' WHERE stdId = $stdId;";
        
        $this->conn->query($UpdateQuerey);
        
    }

}



?>