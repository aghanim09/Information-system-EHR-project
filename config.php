<?php
//attempt to connect to database
$conn = mysqli_connect('localhost','root','','ehr');
//check connection
// if (mysqli_connect_errno()){
//     echo "Falied to connect";
//     exit();
// }
// echo "connection success";
// Check connection
if($conn === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>