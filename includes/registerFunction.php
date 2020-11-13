<?php

$con = mysqli_connect("localhost", "root", "", "test");
if (!$con) {
 die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['register_button'])) {
 $name = mysqli_real_escape_string($con, $_POST['name']);
 $email = mysqli_real_escape_string($con, $_POST['email']);
 $contact = mysqli_real_escape_string($con, $_POST['contact']);
 $dob = mysqli_real_escape_string($con, $_POST['dob']);
 $age = mysqli_real_escape_string($con, $_POST['age']);

 $sql = "insert into tbl_users(name,email,contact,dob,age) values('$name','$email','$contact','$dob','$age')";
 $result = mysqli_query($con, $sql);
 if ($result) {
  header("Location: ../data.php");
  exit();
 } else {
  echo "Insertion is unsuccessful...";
 }
}
