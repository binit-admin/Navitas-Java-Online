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

  if ($_SERVER['REQUEST_METHOD'] == "POST" &&  isset($_POST['classcreate']))
	{
		//if posted
		$classTitle= $_POST['classTitle'];
		$classCode = $_POST['classCode'];
		$dueDate = $_POST['dueDate'];
		$totalMarks = $_POST['totalMarks'];
		$description = $_POST['description'];
		$code_hash = password_hash($classCode, PASSWORD_BCRYPT);
		
		
		$error='';

		$sql =<<<EOF
				
				INSERT INTO classroom (classTitle, classCode, dueDate, totalMarks, description) 
				VALUES ('$classTitle', '$classCode', '$dueDate', '$totalMarks', '$description');
			EOF;
				  $ret = $db->exec($sql);
//check if class is already created into the database

if($ret)
{
sleep(2);
$error .= 'Class is Created Successsfully'.'<br>';
}
echo $error;
  }

 $sqlClass =<<<EOF
		SELECT classTitle, classCode from classroom;
	
	EOF;
	
	$returnC = $db->query($sqlClass);

?>


<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" href="css/createclass.css">
<script src="javascripts/addQn.js" charset="UTF-8">
</script>

</head>

<body>

<header>
<h1>
<img src="objects/navitas.jpeg">
<br><br><br><br>
Logged in as <a href="teacheraccount.php"><?php echo $row['fullName']?></a></h1>

<a href="logout.php" style="float: right;"><b>Logout</b></a>
<br>

<ul>
  <li><a href="student.php">Home</a></li>
  <li><a href="gradesf.php">Grades</a></li>
  <li><a href="resources.php">Resources</a></li>
  <li><a href="teacheraccount.php">Account</a></li>
  <li><a href="https://navitas.com">About</a></li>
</ul>

</header>
<br>

<div class="container">

  <div class="tooltip">



  <p><b>CLASSROOM</b></p>

 <?php
  /*  
    $sql =<<<EOF
    
    INSERT INTO question (user_ID, fullName, dateOFBirth, email, password, confirmPswd, account_type) 
    VALUES ('$user_ID', '$fullName', '$dateOfBirth', '$email', '$password', '$confirmPswd', '$account_type');
  EOF;
      $retn = $db->exec($sql);
*/
?>

<?php
   
	while ($rowC = $returnC->fetchArray(SQLITE3_ASSOC)){

   echo  '<button class="containers" style ="font-weight: bold;" onclick="open2();">'. $rowC['classTitle'].'</button><br>';}
   ?> 
    
    
    <div class="form-popup" id="myForm">
    <form action="teacher.php" class="form-container"><span class="tooltiptext">
      <h5>
    <?php echo $rowC['classTitle']; ?>
  </h5>
      <label class="names"><b>Add question</b></label>
      <input type="texts" placeholder="Enter the question" >
      <label class="names"><b>Link to the sample</b></label>
      <input type="texts" placeholder="Enter the link" >
      <button type="submit" class="registerbtn">Update</button>
      <button type="button" class="registerbtn" onclick="closeForm();">Close</button>
    </form>
    </span>
</div>
    
    </div>
</form>
  </div>
</div>
<br>
<div class="split right">

  <div class="centered">

  <form action="teacher.php" method="POST">

<p><b>NEW CLASS FORM</b></p>

<div class="container">
  <hr>

  <label class="name"><b>Title</b></label>
  <input type="text" placeholder="Enter Title" name= "classTitle" required>

  <label class="name"><b>Class Code</b></label>
  <input type="text" placeholder="Enter Class Code" name= "classCode" required>

  <label class="name"><b> Total Marks</b></label>
  <input type="text" placeholder="Enter Total Marks" name= "totalMarks" required>

  <label class="name"><b>Due by</b></label>
  <input type="date" placeholder="Enter Final Due Date" name= "dueDate" required>

  <label class="name"><b>Description</b></label>
  <input type="text" placeholder="Enter Description" name= "description">


  <hr>
  
  <button type="submit" class="registerbtn" name ="classcreate">CREATE</button>
  <br> <br>
</div>
</form>
  </div>
  </div>




</body>
</html>