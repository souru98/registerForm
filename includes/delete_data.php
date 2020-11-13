<?php

$con = mysqli_connect("localhost", "root", "", "test");
if (!$con) {
 die("Connection failed: " . mysqli_connect_error());
}

$id = mysqli_real_escape_string($con, $_POST['id']);
$sql = "delete from tbl_users where id='$id'";
$result = mysqli_query($con, $sql);
if ($result) {
 header("Location: ../data.php");
 exit();
} else {
 echo "Deletion is unsuccessful...";
}
