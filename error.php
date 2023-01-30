<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>Edit existing record</title> 
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
      .wrapper{
            width: 600px;
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
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5 mb-3">Error</h2>
                    <div class="alert alert-danger">Sorry, something went wrong . Please <a href="records.php" class="alert-link">go back</a> and try again.</div>
                </div>
        </div>
    </div>
</body>
</html>