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

<img src="objects/NJO.png">

<h1>Logged in as <a href="teacheraccount.php"><?php echo $row['fullName']?></a></h1>

<ul>
  <li><a href="#home">Home</a></li>
  <li><a href="#news">News</a></li>
  <li><a href="#contact">Contact</a></li>
  <li><a href="#about">About</a></li>
</ul>

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

<div class="split left">

  <div class="centered">

   <form action="/action_page.php">

  <p><b>CLASSROOM</b></p>

  <div class="container">
    <hr>

    <button class=""><b>Class 1</b></button>

    <button class=""><b>Class 2</b></button>

    <button class=""><b>Class 3</b></button>

    
    <hr>
    
    <button type="submit" class="registerbtn">Create new Class</button>
  </div>
  
</form>


  </div>
</div>



</header>

</body>
</html>