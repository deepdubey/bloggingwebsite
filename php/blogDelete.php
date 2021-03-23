<?php
    include('dbConn.php');
    
    $id = $_GET['id'];
    $delete = "DELETE FROM blogcreated WHERE id='$id';";

    $checkIfIdExistQuery = "SELECT id FROM blogpublished WHERE id='$blogId'";
    $checkIfIdExist = $conn -> query($checkIfIdExistQuery);
    if($checkIfIdExist -> num_rows){
      $delete .= "DELETE FROM blogpublished WHERE gId='$id'";
    }

    $result = $conn -> multi_query($delete);

    if($result){
        header("Location: ./dashboard");
    }
?>