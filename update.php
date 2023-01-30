<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["login"]) || $_SESSION["login"] !== true){
    header("location: Login.php");
    exit;
}

//include config file
require 'config.php';

// retrieve the current user's id from the session
$currentUserId = $_SESSION['id'];

// query to retrieve the EHRs for the current user
$sql = "SELECT * FROM patients WHERE vet_id = $currentUserId";



//Define variables and initialize with empty values 

$cats_name = $owners_name = $phone_number = $birth_date = $weight = $gender = $allergy = $vaccination = $sprayed_neutered = $notes = $record_date = "";
$cats_name_err = $owners_name_err = $phone_number_err = $birth_date_err = $weight_err = $gender_err = $allergy_err = $vaccination_err = $sprayed_neutered_err = $notes_err = $record_date_err = "";

//Processing form data when form is submitted 
if (isset($_POST["id"]) && !empty($_POST["id"])) {
   // Get hidden input value
   $id = $_POST['id'];

   // validate cats name
   $input_cats_name = trim($_POST["cats_name"]);
      if (empty($input_cats_name)){
     $cats_name_err="Please enter cats name";
    } elseif(!filter_var($input_cats_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
      $cats_name_err = "Please enter a valid name.";
   }else{
    $cats_name = $input_cats_name;
  }

  //validate owners name 
  $input_owners_name = trim($_POST["owners_name"]);
  if (empty($input_owners_name)){
    $owners_name_err="Please enter owners name";
  } elseif(!filter_var($input_owners_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
    $owners_name_err = "Please enter a valid name.";
  }else{
    $owners_name = $input_owners_name;
  }

   //validate phone number 
   $input_phone_number= trim($_POST["phone_number"]);
   if (empty($input_phone_number)){
     $phone_number_err="Please enter phone number";
   }else{
    $phone_number = $input_phone_number;
   } 

   //validate birth date 
  $input_birth_date = trim($_POST["birth_date"]);
  if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$input_birth_date)) {
    $birth_date_err = "Please enter a valid birth date in yyyy-mm-dd format.";
    } elseif(empty($input_birth_date)){
          $birth_date_err = "Please enter a Date."; 
  }else{
     $birth_date = $input_birth_date;
  }
    //validate weight
       $input_weight = trim($_POST["weight"]);
       if (empty($input_weight)){
          $weight_err="Please enter weight";
       }else{
           $weight = $input_weight;
       }

          //validate gender
   $input_gender = trim($_POST["gender"]);
   if (empty($input_gender)){
     $gender_err="Please select gender";
   }else{
     $gender = $input_gender;
   }

   //validate allergy
   $input_allergy = trim($_POST["allergy"]);
   if (empty($input_allergy)){
     $allergy_err="Please enter allergy";
   }else{
     $allergy = $input_allergy;
   }

   //validate vaccination 
   $input_vaccination = trim($_POST["vaccination"]);
   if (empty($input_vaccination)){
     $vaccination_err="Please enter vaccination";
   }else{
     $vaccination = $input_vaccination;
   }

   //validate sprayed_neutered
   $input_sprayed_neutered = trim($_POST["sprayed_neutered"]);
  //  if (empty($input_sprayed_neutered)){
  //    $sprayed_neutered_err= "Please enter sprayed or neutered";
  if (!in_array($input_sprayed_neutered, array(" ", "Yes" , "No"))) {
    $sprayed_neutered_err[] = "not valid";
  }else{
    $sprayed_neutered = $input_sprayed_neutered;
  }
  
   //validate notes
   $input_notes = trim($_POST["notes"]);
   if (empty($input_notes)){
     $notes_err= "Please enter notes";
   }else{
    $notes = $input_notes;
   }

     //validate record date
     $input_record_date = trim($_POST["record_date"]);
     if (empty($input_record_date)){
       $record_date_err= "Please enter record_date";
     }else{
      $record_date = $input_record_date;
     }

// Check input errors before inserting in database
         if(empty($cats_name_err) && empty($$owners_name_err) && empty($phone_number_err) && empty($birth_date_err)&& empty($weight_err )&& empty($gender_err)&& empty($allergy_err)&& empty($vaccination_err)&& empty($sprayed_neutered_err)&& empty($notes_err)&& empty($record_date_err)){
// Prepare an update statement
$param_vet_id = $_SESSION[$row["id"]];
$sql = "UPDATE patients SET  (cats_name, owners_name, phone_number, birth_date, weight, gender, allergy,vaccination, sprayed_neutered, notes, record_date, vet_id)
       VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,'$param_vet_id') WHERE id=?";

           if($stmt = mysqli_prepare($conn, $sql)){
//   // Bind variables to the prepared statement as parameters
  mysqli_stmt_bind_param($stmt, "ssssssssi", $param_cats_name, $param_owners_name, $param_phone_number, $param_birth_date, $param_weight, 
  $param_gender, $param_allergy, $param_vaccination, $param_sprayed_neutered, $param_notes, $param_record_date, $param_id);

  // Set parameters
  $param_cats_name = $cats_name;
  $param_owners_name = $owners_name;
  $param_phone_number = $phone_number;
  $param_birth_date = $birth_date;
  $param_weight = $weight;
  $param_gender = $gender;
  $param_allergy = $allergy;
  $param_vaccination = $vaccination;
  $param_sprayed_neutered = $sprayed_neutered;
  $param_notes = $notes;
  $param_record_date = $record_date;
  $param_id = $id;

              // Attempt to execute the prepared statement
              if(mysqli_stmt_execute($stmt)){
                header("location: records.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
        // Close statement
        mysqli_stmt_close($stmt);
    }
        // Close connection
        mysqli_close($conn);
    } else{
        // Check existence of id parameter before processing further
        if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
            // Get URL parameter
            $id =  trim($_GET["id"]);
            // Prepare a select statement
        $sql = "SELECT * FROM patients WHERE id = ?";
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            // Set parameters
            $param_id = $id;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
              $result = mysqli_stmt_get_result($stmt);
  
              if(mysqli_num_rows($result) == 1){
                  /* Fetch result row as an associative array. Since the result set
                  contains only one row, we don't need to use while loop */
                  $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

//                                       // Retrieve individual field value
//                          
                                      $cats_name = $row['cats_name'];
                                      $owners_name = $row['owners_name'];
                                      $phone_number = $row['phone_number'];
                                      $birth_date = $row['birth_date'];
                                      $weight = $row['weight'];
                                      $gender = $row['gender'];
                                      $allergy = $row['allergy'];
                                      $vaccination = $row['vaccination'];
                                      $sprayed_neutered = $row['sprayed_neutered'];
                                      $notes = $row['notes'];
                                      $record_date = $row['record_date'];
                                    } else{
                                      // URL doesn't contain valid id. Redirect to error page
                                      header("location: error.php");
                                      exit();
                                  }
                                  
                              } else{
                                  echo "Oops! Something went wrong. Please try again later.";
                              }
                          }
                          
                          // Close statement
                          mysqli_stmt_close($stmt);
                          
                          // Close connection
                          mysqli_close($conn);
                      }  else{
                          // URL doesn't contain id parameter. Redirect to error page
                          header("location: error.php");
                          exit();
                      }
                  }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>Update existing record</title> 
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
      <h1 class="text-center"> Update record:</h1>

      <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">

      <div class="form-group">
        <label for="cats_name">Patient Name:</label>
        <input type="text" class="form-control <?php echo (!empty($cats_name_err)) ? 'is-invalid' : ''; ?>" name="cats_name" id="cats_name" value="<?php echo $cats_name; ?>"> </input>
        <span class="invalid-feedback"><?php echo $cats_name_err;?></span>
    </div>

    <div class="form-group">
        <label for="owners_name">Owner's Name:</label>
        <input type="text" class="form-control <?php echo (!empty($owners_name_err)) ? 'is-invalid' : ''; ?>" name="owners_name" id="owners_name" value="<?php echo $owners_name; ?>"> </input>
        <span class="invalid-feedback"><?php echo $owners_name_err;?></span>
    </div>

    <div class="form-group">
        <label for="phone_number">Phone Number:</label>
        <input type="tel" class="form-control <?php echo (!empty($phone_number_err)) ? 'is-invalid' : ''; ?>" id="phone_number" name="phone_number" pattern="[0-9]{3}-[0-9]{" value="<?php echo $phone_number; ?>">
        <span class="invalid-feedback"><?php echo $phone_number_err;?></span>
    </div>

    <div class= "form-group">
        <label for="birth_date">Birth Date:</label>
        <input type="date" placeholder="YYYY-MM-DD" class="form-control <?php echo (!empty($birth_date_err)) ? 'is-invalid' : ''; ?>" id="birth_date" name="birth_date" value="<?php echo $birth_date; ?>"> </input>
        <span class="invalid-feedback"><?php echo $birth_date_err;?></span>
    </div>

    <div class="form-group">
        <label for="weight">Weight:</label>
        <input type="number" placeholder="KG" class="form-control <?php echo (!empty($weight_err)) ? 'is-invalid' : ''; ?>" id="weight" name="weight" min="0" step="0.1" value="<?php echo $weight; ?>"> </input>
        <span class="invalid-feedback"><?php echo $weight_err;?></span>
    </div>

    <div class="form-group">
        <label for="gender">Gender:</label>
        <select id="gender" class="form-control <?php echo (!empty($gender_err)) ? 'is-invalid' : ''; ?>" name="gender" value="<?php echo $gender; ?>"> </input>
        <option value="">Select Gender</option>
        <option value="male">Male</option>
        <option value="female">Female</option>
    </select>
    <span class="invalid-feedback"><?php echo $gender_err;?></span>
    </div>

    <div class="form-group">
        <label for="allergy">Allergy:</label>
        <input type="text" class="form-control <?php echo (!empty($allergy_err)) ? 'is-invalid' : ''; ?>" id="allergy" name="allergy" value="<?php echo $allergy; ?>"> </input>
        <span class="invalid-feedback"><?php echo $allergy_err;?></span>
    </div>

    <div class="form-group">
        <label for="vaccination">Vaccination:</label>
        <input type="text" class="form-control <?php echo (!empty($vaccination_err)) ? 'is-invalid' : ''; ?>" id="vaccination" name="vaccination" value="<?php echo $vaccination; ?>"> </input>
        <span class="invalid-feedback"><?php echo $vaccination_err;?></span>
      </div>

    <div class="form-group">
        <label for="spayed_neutered">Is cat sprayed/neutered?</label>
        <select id="sprayed_neutered" class="form-control <?php echo (!empty($sprayed_neutered_err)) ? 'is-invalid' : ''; ?>" name="sprayed_neutered" value="<?php echo $sprayed_neutered; ?>"> </input>
        <option value="">Select</option>
        <option value="yes">Yes</option>
        <option value="no">No</option>
    </select>
    <span class="invalid-feedback"><?php echo $sprayed_neutered_err;?></span>
    <div>

    <div class="form-group">
        <label for="notes">Notes:</label>
        <textarea id="notes" class="form-control <?php echo (!empty($notes_err)) ? 'is-invalid' : ''; ?>" name="notes" value="<?php echo $notes; ?>"> </textarea>
        <span class="invalid-feedback"><?php echo $notes_err;?></span>
      </div>

    <div class="form-group">
        <label for="record_date">Record Date:</label>
        <input type="date" class="form-control <?php echo (!empty($record_date_err)) ? 'is-invalid' : ''; ?>" id="record_date" name="record_date" aria-colspan="" value="<?php echo $record_date; ?>"> </input>
        <span class="invalid-feedback"><?php echo $record_date_err;?></span>
      </div>

    <input type="hidden" name="id" value="<?php echo $patient['id']; ?>">
    <input type="submit"  class="btn btn-secondary ml-2" value="Update">
    <a href="records.php" class="btn btn-secondary ml-2">Cancel</a>
        </form>
      
        
    <footer>
      <div class="container mt-5">
        <p>Copyright © 2023 Aiganym Kenges</p>
      </div>
    </footer>
  </body>

</html>