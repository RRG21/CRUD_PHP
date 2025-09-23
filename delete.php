<?php
    include 'db_connection.php';

    $id = $_GET['id'];

    $query = "DELETE FROM `from_01` WHERE `id` = $id";

    $data=mysqli_query($conn,$query);

    if(!$data){
        echo "Record Not Deleted";
    }
    else{
        echo "Record Deleted";
        header("Location: view.php");
    }
?>