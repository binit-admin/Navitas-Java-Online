<?php
use mysql_xdevapi\ColumnResult;

session_start();
    require_once("connection.php");
    	
    $email= $_SESSION['email'];
	$sql3 =<<<EOF
		SELECT * from account
		WHERE email='$email';
	
	EOF;
	
	$return3 = $db->query($sql3);
	$row = $return3->fetchArray(SQLITE3_ASSOC);

    if ($_SERVER['REQUEST_METHOD'] == "POST" &&  isset($_POST['register']))
    {
        $fullName= $_POST['name'];
		$email = $_POST['email'];
        $dateOfBirth = $_POST['dateOfBirth'];
        $address = $_POST['address'];
        $course = $_POST['course'];

        $account = random(10);
				$sql5 =<<<EOF
				
				INSERT INTO account (name, account#, email, studentID, dateOfBirth, address, course) 
				VALUES ('$fullName', '$dateOfBirth', '$email', '$password', '$confirmPswd', '$account_type');
			EOF;
				  $return1 = $db->exec($sql5);
    }



?>


<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" href="css/stdaccount.css">

</head>
<body>

<h2>Update Your Details</h2>

<div class="container">
  <form action="studentaccount.php" method="POST">
  <div class="row">
    <div class="col-25">
      <label for="fname"> Full Name</label>
    </div>
    <div class="col-75">
      <input type="text" id="fname" name="firstname" value="<?php echo $row['fullName']?>">
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="email">Email Address</label>
    </div>
    <div class="col-75">
      <input type="text" id="email" name="email" value="<?php echo $row['email']?>"> 
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="DateOfBirth"> Date of Birth</label>
    </div>
    <div class="col-75">
        <input type="text" id="dob" name="DateOfBirth" value="<?php echo $row['dateOfBirth']?>"> 
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="address">Address</label>
    </div>
    <div class="col-75">
      <input type="text" id="address" name="address">
    </div>
  </div>

  <div class="row">
    <div class="col-25">
      <label for="course"> Course</label>
    </div>
    <div class="col-75">
      <input type="text" id="course" name="course">
    </div>
  </div>
  <div class="row">
    <input type="submit" value="Submit" name="register">
  </div>
  </form>
</div>

</body>
</html>
