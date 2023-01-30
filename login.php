<?php
// initialize the session
session_start();

require 'config.php';

// check if the user has submitted the form
if (isset($_POST["submit"])) {
    $usernameemail = $_POST["usernameemail"];
    $password = $_POST["password"];
    $result = mysqli_query($conn, "SELECT * FROM users WHERE username='$usernameemail' OR email='$usernameemail'");
    $row = mysqli_fetch_assoc($result);

    // check if the user is registered
    if (mysqli_num_rows($result) > 0) {
        // check if the password is correct
        if (password_verify($password, $row["password"])) {
            // start a new session
            session_regenerate_id();
            $_SESSION["login"] = true;
            $_SESSION["id"] = $row["id"];
            header("Location:index.php");
        } else {
            echo "<script> alert('Incorrect Password '); </script>";
        }
    } else {
        echo "<script> alert('User is not registered '); </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <title>Login</title>
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
    <h2>Login</h2>
    <form action="" method="post" autocomplete="off">
    <div class="form-group">
        <label for="usernameemail">Username or Email:</label>
        <input type="text" class="form-control" name="usernameemail" id="usernameemail" required>
    </div>
    <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" class="form-control" name="password" id="password" required>
        <div>
        <button type="submit"  class="btn btn-secondary ml-2" name="submit">Login</button>
    </form>
    </div>
  <br>
  
    <button type="button"class="btn btn-secondary ml-2" onclick="location.href='registration.php'">Register</button>


    <div id="footer">
      Copyright © 2023 Aiganym Kenges
    </div>
</body>
</html>


