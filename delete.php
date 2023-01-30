<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["login"]) || $_SESSION["login"] !== true){
    header("location: Login.php");
    exit;
}
?>

<?php
// process delete operation after confirmation
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // include config file
    require_once "config.php";
    
    // prepare a delete statement
    $sql = "DELETE FROM patients WHERE id = ?";    
    if($stmt = mysqli_prepare($conn, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);
                // Set parameters
                $param_id = trim($_POST["id"]);
        
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    // Records deleted successfully. Redirect to landing page
                    header("location: records.php");
                    exit();
                } else{
                    echo "Oops! Something went wrong. Please try again later.";
                }
            }
             
            // Close statement
            mysqli_stmt_close($stmt);
            
            // Close connection
            mysqli_close($conn);
        } else{
            // Check existence of id parameter
            if(empty(trim($_GET["id"]))){
                // URL doesn't contain id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
        }
        ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        header {
          background-color: pink;
          padding: 30px;
          text-align: center;
        }
        #content {
          padding: 50px;
          text-align: center;
        }
        footer {
          background-color: #f1f1f1;
          padding: 10px;
          text-align: center;
          color: purple;
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
  
<div id="content">
    <h2 class="text-center">Delete Record</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="alert alert-danger">
            <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>"/>
            <p>Are you sure you want to delete this Patient record?</p>
            <p>
                <input type="submit" value="Yes" class="btn btn-danger">
                <a href="records.php" class="btn btn-secondary">No</a>
            </p>
        </div>
   


</body>
</html>