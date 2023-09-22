<?php

$conn = mysqli_connect("localhost","root","","modal");

if(!$conn){
    die ("failed".mysqli_error($conn));
}else{
    // echo "connect";
}

?>