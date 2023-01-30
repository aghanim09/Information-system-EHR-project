<?php
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["login"]) || $_SESSION["login"] !== true) {
    header("location: Login.php");
    exit;
}
//include config file
require 'config.php';

// retrieve the current user's id from the session
$currentUserId = $_SESSION['id'];

// query to retrieve the EHRs for the current user
$sql = "SELECT * FROM patients WHERE vet_id = $currentUserId";
$result = mysqli_query($conn, $sql);

// check if query result is not empty
if (!$result) {
    echo "Could not retrieve data from the database.";
  header("Location:error.php");
}

// close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>Records Page</title> 
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
        background-color: pink; 
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
        color: #d3c3f4; 
      }
      .form-group {
        margin-bottom: 20px;
      }
      .form-control {
        width: 50%;
        margin: 0 auto;
      }
    </style>
    <style>
		table, tr, th, td {
			border: 1px solid #aaa;
			border-collapse: collapse;
			padding: 5px;
		}
		th {background: #d3c3f4}
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
      <h1 class="text-center">Patient records</h1>
      <?php if(mysqli_num_rows($result)){ ?>
		<br />
		<mark>
			<?php if (isset($_GET['ms'])) {
				echo $_GET['ms'];
			} ?>
		</mark>
      <table>
      <tr>
        <tr>
          <th>#</th>
          <th>Patient Name</th>
          <th>Owners Name</th>
          <th>Phone Number</th>
          <th>Birth day</th>
          <th>Weight</th>
          <th>Gender</th>
          <th>Allergy</th>
          <th>Vaccination</th>
          <th>Sprayed/Neutered</th>
          <th>Notes</th>
          <th>Record Creation Date</th>
          <th> Action </th>
        </tr>
      </tr>
      <tbody>
      <?php 
      $param_id = $_SESSION["id"];
      
            $i = 0;
            while ($patients = mysqli_fetch_assoc($result)) {
            $i++;
		 ?>
     		<tr>
           <td><?=$i?></td>
           <td><?=$patients['cats_name']?></td>
           <td><?=$patients['owners_name']?></td>
           <td><?=$patients['phone_number']?></td>
           <td><?=$patients['birth_date']?></td>
           <td><?=$patients['weight']?></td>
           <td><?=$patients['gender']?></td>
           <td><?=$patients['allergy']?></td>
           <td><?=$patients['vaccination']?></td>
           <td><?=$patients['sprayed_neutered']?></td>
           <td><?=$patients['notes']?></td>
           <td><?=$patients['record_date']?></td>
           <td>
           <a href="update.php?id=<?=$patients['id']?>" class="btn btn-secondary ml-2">Edit</a>
           <br>
           <br>
           <a href="delete.php?id=<?=$patients['id']?>" class="btn btn-secondary ml-2" >Delete</a>
           </td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
    <br />
	<a href="create.php" class="btn btn-secondary ml-2">Create new record</a>
<?php }else{ ?>
	<h1>Empty! No records</h1>
	<a href="create.php" class="btn btn-secondary ml-2">Create new record</a>
<?php } ?>

  </div>

    <footer>
      <div class="container mt-5">
        <p>Copyright © 2023 Aiganym Kenges</p>
      </div>
    </footer>
  </body>

</html>

