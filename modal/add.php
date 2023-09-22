<?php

include 'conn.php';

if(isset($_POST['add'])){

    $name = $_POST['name'];
    $age = $_POST['age'];

    if(empty($name) || empty($age)){
        header('location:index.php?message=YO need to fill in the firstname!');
    }else{

    $query = "INSERT INTO `modal`(`name`,`age`) values ('$name','$age')";

    $result = mysqli_query($conn,$query);


    if(!$result){
        echo ("failed".mysqli_error($conn));
    }else{
        header('location:index.php');
    }
}
}


?>