
<?php
// ini_set('display_errors', 1);
// error_reporting(E_ALL);

// Connect to the database
require 'config.php';

if(isset($_POST["submit"])){
  // get form data
  $name = $_POST["name"];
  $username = $_POST["username"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  $confirmpassword = $_POST["confirmpassword"];
  //check if the username or password is already taken
  $duplicate = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username' OR email = '$email'");
  if(mysqli_num_rows($duplicate) > 0){
    echo
    "<script> alert('Username or Email Has Already Taken'); </script>";
  }
  else{
    //chek if the passwords match 
    if($password == $confirmpassword){
      //hash the password for security 
      $hashed_password = password_hash($password, PASSWORD_DEFAULT);
      //insert data into the database 
      $query = "INSERT INTO users (name, username, email, password) VALUES ('$name', '$username', '$email', '$hashed_password')";
      mysqli_query($conn, $query);
      echo
      "<script> alert('Registration Successful! You can log in now!'); </script>";
    }
    else{
      echo
      "<script> alert('Password Does Not Match'); </script>";
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>Registration</title>
    <!-- styling page -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
      #header {
        background-color: pink; /*change the background color to pink*/
        padding: 30px;
        text-align: center;
      }
      #content {
        padding: 50px;
        text-align: center;
      }
      #footer {
        background-color: #f1f1f1;
        padding: 10px;
        text-align: center;
        color: purple; /*change the text color to purple*/
      }
      .form-group {
        margin-bottom: 20px;
      }
      .form-control {
        width: 50%;
        margin: 0 auto;
      }
    </style>
  </head>
  <body>

  <div id="header">
      <h1>Mitze Care </h1>
    </div>

<div id="content">

    <h2>Registration</h2>
  
    <form  action="" method="post" autocomplete="off">
    <div class="form-group">
      <label for="name">Name : </label>
      <input type="text"  class="form-control" name="name" id = "name" required value="">
    </div>
    <div class="form-group">
      <label for="username">Username : </label>
      <input type="text"  class="form-control" name="username" id = "username" required value=""> 
    </div>
    <div class="form-group">
      <label for="email">Email : </label>
      <input type="email"  class="form-control" name="email" id = "email" required value="">
       <div>
       <div class="form-group">
      <label for="password">Password : </label>
      <input type="password"  class="form-control" name="password" id = "password" required value=""> 
    </div>
    <div class="form-group">
      <label for="confirmpassword">Confirm Password : </label>
      <input type="password"  class="form-control" name="confirmpassword" id = "confirmpassword" required value="">
    </div>
      <button type="submit" class="btn btn-secondary ml-2"  name="submit">Register</button>
    </form>
    <br>
    <br>
    <button type="button"class="btn btn-secondary ml-2" onclick="location.href='login.php'">Login</button>
    <div id="footer">
    </div>
      Copyright © 2023 Aiganym Kenges
    
  </body>
</html>

