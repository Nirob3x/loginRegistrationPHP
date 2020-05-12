<?php
include 'connection/connection.php';

session_start();
$email = $_SESSION['userEmail'];


$sql = "UPDATE tbl_user SET status='0' WHERE username='$email'";
$resu = $conn->query($sql);

session_destroy();

header('location:index.php');
exit();

?>