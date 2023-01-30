<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["login"]) || $_SESSION["login"] !== true){
    header("location: Login.php");
    exit;
}

//check if vet ID is stored in session and retrive it 
if(isset($_SESSION["id"])){
  $currentUserId = $_SESSION['id'];
}

require 'config.php';

if (isset($_POST["submit"])) {
    // get form data
    $cats_name = $_POST["cats_name"];
    $owners_name = $_POST["owners_name"];
    $phone_number = $_POST["phone_number"];
    $birth_date = $_POST["birth_date"];
    $weight = $_POST["weight"];
    $gender = $_POST["gender"];
    $allergy = $_POST["allergy"];
    $vaccination = $_POST["vaccination"];
    $sprayed_neutered = $_POST["sprayed_neutered"];
    $notes = $_POST["notes"];
    $record_date = $_POST["record_date"];

    // validate form data
    if(empty($cats_name) || empty($owners_name) || empty($phone_number) || empty($birth_date) || empty($weight) || empty($gender) || empty($allergy) || empty($vaccination) || empty($sprayed_neutered) || empty($notes) || empty($record_date)) {
        echo "<script>alert('Please fill out all fields.');</script>";
    } else {
        // insert data into the database 
        $query = "INSERT INTO patients (cats_name, owners_name, phone_number, birth_date, weight, gender, allergy,vaccination, sprayed_neutered, notes, record_date)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 'ssssssssssi', $cats_name, $owners_name, $phone_number, $birth_date, $weight, $gender, $allergy, $vaccination, $sprayed_neutered, $notes, $record_date,$vet_id);
        if(mysqli_stmt_execute($stmt)) {
            echo "<script>alert('You've added new patient.');</script>";
            // redirect to another page
            header("Location: records.php");
        } else {
          echo "<script>alert('Error adding patient: " . mysqli_error($conn) . "');</script>";
      header("Location:error.php");
      }         // Close statement
      mysqli_stmt_close($stmt);
  }     // Close connection
  mysqli_close($conn);
}
?> 

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>Create new record</title> 
     <!-- styling page -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $( function() {
            $( "#datepicker" ).datepicker();
        } );
    </script>
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

    <div class="container">
      <h1 class="text-center"> Create new record:</h1>

      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <div class="form-group">
        <label for="cats_name">Patient Name:</label>
        <input type="text" class="form-control" name="cats_name" id="cats_name" required>
    </div>
    <div class="form-group">
        <label for="owners_name">Owner's Name:</label>
        <input type="text" class="form-control" name="owners_name" id="owners_name"  required>
    </div>
    <div class="form-group">
        <label for="phone_number">Phone Number:</label>
        <input type="tel" class="form-control" id="phone_number" name="phone_number" pattern="[0-9]{3}-[0-9]{">
    </div>
    <div class= "form-group">
        <label for="birth_date">Birth Date:</label>
        <input type="date" class="form-control" id="birth_date" name="birth_date" required>
    </div>
    <div class="form-group">
        <label for="weight">Weight:</label>
        <input type="number" class="form-control" id="weight" name="weight" min="0" step="0.1" required>
    </div>
    <div class="form-group">
        <label for="gender">Gender:</label>
        <select id="gender" class="form-control" name="gender" required>
        <option value="">Select Gender</option>
        <option value="male">Male</option>
        <option value="female">Female</option>
    </select>

    </div>
    <div class="form-group">
        <label for="allergy">Allergy:</label>
        <input type="text"class="form-control" id="allergy" name="allergy" required>
    </div>
    <div class="form-group">
        <label for="vaccination">Vaccination:</label>
        <input type="text" class="form-control" id="vaccination" name="vaccination" required>
    </div>
    <div class="form-group">
        <label for="spayed_neutered">Is cat sprayed/neutered?</label>
        <select id="sprayed_neutered" class="form-control" name="sprayed_neutered" required>
        <option value="">Select</option>
        <option value="yes">Yes</option>
        <option value="no">No</option>
    </select>
    <div>
    <div class="form-group">
        <label for="notes">Notes:</label>
        <textarea id="notes" class="form-control" name="notes"></textarea>
    </div>
    <div class="form-group">
        <label for="record_date">Record Date:</label>
        <input type="date" class="form-control" id="record_date" name="record_date" aria-colspan="" required>
    </div>
    <input type="submit" name="submit"class="btn btn-secondary ml-2"  value="Create Record">
    <a href="records.php" class="btn btn-secondary ml-2">Cancel</a>
        </form>

    <footer>
      <div class="container mt-5">
        <p>Copyright © 2023 Aiganym Kenges</p>
      </div>
    </footer>
  </body>

</html>