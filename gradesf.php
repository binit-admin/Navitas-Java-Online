<?php 
session_start();
require_once("connection.php");

$email= $_SESSION['email'];
	$sql6 =<<<EOF
		SELECT * from account
		WHERE email='$email';
	
	EOF;
	
	$return6 = $db->query($sql6);
	$row = $return6->fetchArray(SQLITE3_ASSOC);

?>

<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> Grades:Teacher's view </title>
  <link rel="stylesheet" href="css/slide menu.css">

</head>

<body>
  <div class="headers">
    <h1><img src="objects/NJO.png" alt="NJO">
      Logged in as <a href=""><?php echo $row['fullName']?></a></h1>
  </div>

  <div id="mySidenav"class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    
    <div class="sidenav-content">
      <a href="#">Home</a>
      <a href="#">Grades</a>
      <button class="dropdown-btn">Classes
        <i class="arrow down"></i>
      </button>
      <div class="dropdown-container">
        <a href="#">Class1</a>
        <a href="#">Class2</a>
        <a href="#">Class3</a>
        </div>
        <a href="#">Logout</a>
    </div>
  </div>
      <script>
        /* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
        var dropdown = document.getElementsByClassName("dropdown-btn");
        var i;
        
        for (i = 0; i < dropdown.length; i++) {
          dropdown[i].addEventListener("click", function() {
          this.classList.toggle("active");
          var dropdownContent = this.nextElementSibling;
          if (dropdownContent.style.display === "block") {
          dropdownContent.style.display = "none";
          } else {
          dropdownContent.style.display = "block";
          }
          });
        }
        </script>
    
  

  <h2> <span style="font-size:30px;cursor:pointer"
     onclick="openNav()"> &#9776; Grades</span>
  </h2>
  <script>
    function openNav() {
      document.getElementById("mySidenav").style.width = "250px";
    }
    
    function closeNav() {
      document.getElementById("mySidenav").style.width = "0";
    }
    </script>


  <h3> Grades for Class: 1 </h3>

  <table>
    <tr>
      <th>Student Name</th>
      <th>Student ID </th>
      <th>REVIEW LINK</th>
      <th>MARKS</th>
    </tr>
    <tr>
      <th>alice alice</th>
      <th>23456678</th>
      <th><u style="color: blue;">review</th>
      <th>80/100</th>
    </tr>
    <tr>
      <th>binit binit</th>
      <th>12345678</th>
      <th><u>review</th>
      <th>80/100</th>
    </tr>
    <tr>
      <th>prashamsa sapkota</th>
      <th>20987542 </th>
      <th><u>review</th>
      <th>80/100</th>
    </tr>
    <tr>
      <th>shishir shishir</th>
      <th>53735478 </th>
      <th><u>review</th>
      <th>80/100</th>
    </tr>
    <tr>
      <th>wardah wardah</th>
      <th>24363922</th>
      <th><u>review</th>
      <th>80/100</th>
    </tr>
    <tr>
      <th>thomas remous</th>
      <th>26898300 </th>
      <th><u>review</th>
      <th>80/100</th>
    </tr>

  </table>  
</body>
</html>