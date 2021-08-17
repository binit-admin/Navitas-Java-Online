<?php
session_start();
    require_once("connection.php");
    	
    $email= $_SESSION['email'];
	$sql7 =<<<EOF
		SELECT * from account
		WHERE email='$email';
	
	EOF;
	
	$return7 = $db->query($sql7);
	$row = $return7->fetchArray(SQLITE3_ASSOC);


?>

<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> Grades:Student view </title>
  <link rel="stylesheet" href="css/menugradesheet.css">
</head>

<body>
  <div class="headers">
    <h1><img src="objects/NJO.png" alt="NJO">Logged in as <a href=""><u><?php echo $row['fullName']?> </u></a>
    </h1>
    <div id="mySidenav" class="sidenav">
      <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
      <div class="sidenav-content">
        <a href="#">Classes</a>
        <a href="#">Grades</a>
        <a href="#">Resources</a>
        <a href="#">Practice Q&A</a>
      </div>
    </div>

    <h2> <span style="font-size:30px;cursor:pointer" onclick="openNav()"> &#9776; Navitas Classroom</span>
    </h2>
    <script>
      function openNav() {
        document.getElementById("mySidenav").style.width= "250px";
      }

      function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
      }
    </script>
    <h3>Overview: Report</h3>

    <table>
      <tr>
        <th>Classes/Topic Name</th>
        <th>Grades </th>

      </tr>
      <tr>
        <th>Class1- Loop</th>
        <th>30/100</th>

      </tr>
      <tr>
        <th>Class2- Sequence</th>
        <th>80/100</th>
      </tr>
      <tr>
        <th>Class3- Array</th>
        <th>80/100</th>
      </tr>
      <tr>
        <th>Class4- Series</th>
        <th>-</th>

    </table>


  </div>

</body>

</html>
