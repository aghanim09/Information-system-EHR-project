<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["login"]) || $_SESSION["login"] !== true){
    header("location: Login.php");
    exit;
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
           /* Styles for the calendar table */
           table {
        border-collapse: collapse;
        width: 100%;
      }
      th, td {
        border: 1px solid black;
        padding: 8px;
        text-align: center;
      }
      /* Style for the navigation buttons */
      .nav-btn {
        background-color: #ddd;
        color: black;
        border: none;
        padding: 8px 16px;
        text-decoration: none;
        margin: 4px 2px;
        cursor: pointer;
      }
      /* Style for the current day */
      .today {
        background-color: #d3c3f4;
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

  <body>
    <h1 class="text-center">Calendar</h1>
    <table id="calendar">
      <thead>
        <tr>
          <th colspan="7">
            <button class="nav-btn" id="prev-month">&lt;</button>
            <span id="month"></span>
            <button class="nav-btn" id="next-month">&gt;</button>
          </th>
        </tr>
        <tr>
          <th>Sun</th>
          <th>Mon</th>
          <th>Tue</th>
          <th>Wed</th>
          <th>Thu</th>
          <th>Fri</th>
          <th>Sat</th>
        </tr>
      </thead>
      <tbody id="calendar-body"></tbody>
    </table>
    <script>
      // Get the current date
      var today = new Date();
      var currentMonth = today.getMonth();
      var currentYear = today.getFullYear();
      
      // Get the elements for the calendar
      var calendarBody = document.getElementById("calendar-body");
      var monthLabel = document.getElementById("month");
      var prevMonthBtn = document.getElementById("prev-month");
      var nextMonthBtn = document.getElementById("next-month");
      
      // Create the calendar
      function createCalendar(month, year) {
        // Clear the calendar
        calendarBody.innerHTML = "";
        
        // Get the first day of the month
        var firstDay = new Date(year, month, 1);
        var firstDayOfWeek = firstDay.getDay();
        
        // Get the last day of the month
        var lastDay = new Date(year, month + 1, 0);
        var lastDate = lastDay.getDate();
        
        // Get the month name
        var monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        monthLabel.innerHTML = monthNames[month] + " " + year;
        
        // Create the calendar rows
        var date = 1;
        for (var i = 0; i < 6; i++) { // 6 rows
          var row = document.createElement("tr");
          for (var j = 0; j < 7; j++) { // 7 columns
            var cell = document.createElement("td");
            if (i === 0 && j < firstDayOfWeek) {
              cell.innerHTML = "";
            } else if (date > lastDate) {
              break;
            } else {
              cell.innerHTML = date;
              if (date === today.getDate() && month === today.getMonth() && year === today.getFullYear()) {
                cell.classList.add("today");
              }
              date++;
            }
            row.appendChild(cell);
          }
          calendarBody.appendChild(row);
        }
      }
      
      // Show the current month
      createCalendar(currentMonth, currentYear);
      
      // Go to the previous month
      prevMonthBtn.addEventListener("click", function() {
        currentYear = (currentMonth === 0) ? currentYear - 1 : currentYear;
        currentMonth = (currentMonth === 0) ? 11 : currentMonth - 1;
        createCalendar(currentMonth, currentYear);
      });
      
      // Go to the next month
      nextMonthBtn.addEventListener("click", function() {
        currentYear = (currentMonth === 11) ? currentYear + 1 : currentYear;
        currentMonth = (currentMonth + 1) % 12;
        createCalendar(currentMonth, currentYear);
      });
  </script>
    <footer>
      <div class="container mt-5">
        <p>Copyright © 2023 Aiganym Kenges</p>
      </div>
    </footer>
  </body>

</html>