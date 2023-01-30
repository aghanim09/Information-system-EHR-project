
<?php


//check the status of the session 
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

require 'config.php';

if(!empty($_SESSION["id"])){
	$id = $_SESSION["id"];
	$result = mysqli_query($conn, "SELECT*FROM users WHERE ID=$id");
	$row = mysqli_fetch_assoc($result);
} else{
	header("Location:login.php");
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>Home Page</title> 
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

  <header>
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">EHR for Cats <br> ฅ^•ﻌ•^ฅ</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="records.php">Records</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="appointments.php">Appointments</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="contact.php">Contact</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="logout.php">Log out</a>
              
            </li>
          </ul>
        </div>
      </nav>
    </header>
   
<div id="header">
      <h1>Mitze Care </h1>
    </div>
   
    <main>
      <div class="container mt-5">
        <h2 class="text-center">Welcome to Mitze Care </h2>
        <p>    This is website is created to provide a platform for veterinarians where they can store Electronic Health Records(EHR) of your beloved cats.
          An electronic health record (EHR) is a digital version of a pet's medical history, including information such as vaccinations, medications, allergies, and past illnesses.
           EHRs for pets are becoming increasingly common as technology advances and more veterinarians adopt digital record-keeping systems. 
           These records are stored on secure servers and can be accessed by authorized individuals, such as veterinarians and pet owners, from any location with an internet connection. 
           EHRs can improve communication between veterinarians, allow for more efficient and accurate record-keeping, and provide pet owners with easy access to their pet's medical history.</p>
           <p>Below, you can see a photo of my beloved cat named Mitze. She was my inspiration for this project.</p>
        <div center>
        <img src="Mitze.jpg" alt="mieze1" width=100% height=50%>
    </div>
    </main>
   

    <footer>
      <div class="container mt-5">
        <p>Copyright © 2023 Aiganym Kenges</p>
      </div>
    </footer>
  </body>

</html>










