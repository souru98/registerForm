<?php 

$con = mysqli_connect("localhost","root","","test");
if(!$con){
 die("Connection failed: ".mysqli_connect_error());
}
