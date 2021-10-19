<?php
session_start();
    require_once("connection.php");
    $x =0;
    //for session user 
    $email= $_SESSION['email'];
	$sql3 =<<<EOF
		SELECT * from account
		WHERE email='$email';
	
	EOF;
	
	$return3 = $db->query($sql3);
	$row = $return3->fetchArray(SQLITE3_ASSOC);

    //for available classes to enter to 
  $sqlClass =<<<EOF
		SELECT * from classroom;
	
	EOF;
	
	$returnC = $db->query($sqlClass);

?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="css/class2.css">


</head>

<body>

    <header>
        <h1>
            <img src="objects/navitas.jpeg">

            <br><br><br><br><br><br>

            Logged in as <a class="name" alt="Student's_name"><u><?php echo $row['fullName']?> </u></a><br>
            <a href="logout.php" style="float: right;"><b>Logout</b></a><br>

        </h1>

        <ul>
            <li><a href="student.php">Home</a></li>
            <li><a href="studentgradesheet.php">Grades</a></li>
            <li><a href="https://www.latrobe.edu.au/students/study-resources/learninghub/coding-hub">Resources</a></li>
            <li><a href="studentaccount.php">Account</a></li>
            <li><a href="https://navitas.com">About</a></li>
        </ul>
    </header>
    <h2> Navitas Classroom </h2>
    <span id = "button2Class"> 
    <?php
   
	while ($rowC = $returnC->fetchArray(SQLITE3_ASSOC)){
     $x= $x+1;   
    echo '<button style= "margin: 40px 50px 10px 110px;" class="open-modal" id ="$x" onclick = "showModal();"';
    echo '><b> <font size="5">'.$rowC['classTitle'].'</font><br><br>DUE BY: </b>' .$rowC['dueDate'].' </button>';
  
$whichClass= $rowC['classTitle'];
}
    ?>
</span>
<center>
  
<div class="modal demo-modal">
  <div class="modal-content"><form action ="student.php" method="POST">
    <div class="modal-header">
      <span class="close">x</span>
      <h3>Enter the code</h3>
    </div>
    
    <div class="modal-body">
      <input type="text" placeholder="Enter Code" id="code" name="code" protected/>
           
    </div>
    <div class="modal-footer">    
        <button class="joinbtn" id="btn" name="join" value="Join" ><a style="text-decoration: none" href="classroom.php">Join</a></button>
</div>
</form>  
  </div>
</div>

</center>

<?php 


     if ($_SERVER['REQUEST_METHOD'] == "POST" &&  isset($_POST['join']))
{
  $code = $_POST['code'];
  echo $code;

  $sqlClass=<<<EOF
		SELECT classCode from classroom
		WHERE classTitle=$whichClass;
	
	EOF;
	
	$returnC1 = $db->query($sqlClass);

$rowC1 = $returnC1->fetchArray(SQLITE3_ASSOC);
if ($rowC1){
 if ($code == $rowC1['classCode'])
  {
    echo '';
    header("Location: classroom.php");
  }
  else{
    echo 'Incorrect Code';
    header("Location: teacher.php");

  }
}
else
{
  echo 'No Such Class';
}
}

?>
  
    <script src="javascripts/test.js"></script>
</body>

</html>