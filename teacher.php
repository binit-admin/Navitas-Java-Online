<?php

session_start();
    require_once("connection.php");
    	
    $email= $_SESSION['email'];
	$sql3 =<<<EOF
		SELECT * from account
		WHERE email='$email';
	
	EOF;
	
	$return3 = $db->query($sql3);
	$row = $return3->fetchArray(SQLITE3_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" href="css/createclass.css">
<script src="javascripts/two.js" charset="UTF-8"></script>

</head>

<body>

<header>
<h1>
<img src="objects/NJO.png">
<br><br><br><br>
Logged in as <a href="teacheraccount.php"><?php echo $row['fullName']?></a></h1>

<ul>
  <li><a href="student.php">Home</a></li>
  <li><a href="studentgradesheet.php">Grades</a></li>
  <li><a href="resources.php">Resources</a></li>
  <li><a href="studentaccount.php">Account</a></li>
  <li><a href="https://navitas.com">About</a></li>
</ul>

</header>
<br>

<div class="left">

  <div class="center">

   <form action="/action_page.php">

  <p><b>CLASSROOM</b></p>

  <div class="container">
    

    <button class="containers"><b>Class 1</b></button>
    <br>
    <button class="containers"><b>Class 2</b></button>
    <br>
    <button class="containers"><b>Class 3</b></button>
    <br>
    
    
    
    <button type="submit" class="registerbtn">Create new Class</button>
  </div>
  
</form>


  </div>
</div>

<div class="split right">

  <div class="centered">

<form action="/action_page.php">

	<p><b>NEW CLASS FORM</b></p>

  <div class="container">
    <hr>

    <label class="name"><b>Title</b></label>
    <input type="text" placeholder="Enter Title" >

    <label class="name"><b>Class Code</b></label>
    <input type="password" placeholder="Enter Class Code">

    <label class="name"><b>Description</b></label>
    <input type="text" placeholder="Enter Description" >

    <label class="name"><b>Due by</b></label>
    <input type="text" placeholder="Enter Final Due Date" >

    <hr>
    
    <button type="submit" class="registerbtn">CREATE</button>
  </div>
  
</form>
  </div>
  </div>




</body>
</html>