<?php  
  
  include 'conn.php';

  if(isset($_GET['id'])){
     $id = $_GET['id'];
  }

  $query = "DELETE from `modal` WHERE `id` = '$id'";
 
  
  $result = mysqli_query($conn,$query);

  if(!$result){
    die ("Query failed" . mysqli_error());
  }
  else{
    header('location:index.php');
  }




?>