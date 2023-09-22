<?php
include 'conn.php';

if(isset($_POST['checking_edit_btn'])){
    $id = $_POST['student_id'];

    $query = "SELECT * FROM `modal` WHERE `id` = '$id'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    } else {
        $row = mysqli_fetch_assoc($result);
        $response = array(
            'success' => true,
            'data' => $row
        );
        echo json_encode($response);
    }
} else if (isset($_POST['edit'])) {
    $idnew = $_POST['edit_id'];
    $name = $_POST['name'];
    $age = $_POST['age'];

    $query = "UPDATE `modal` SET `name` = '$name', `age` = '$age' WHERE `id` = '$idnew'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        echo ("failed" . mysqli_error($conn));
    } else {
        header('location:index.php');
    }
}
?>
