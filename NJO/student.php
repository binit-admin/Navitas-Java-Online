<?php
session_start();
    require_once("connection.php");
    
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
		SELECT classTitle, classCode, dueDate from classroom;
	
	EOF;
	
	$returnC = $db->query($sqlClass);

?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="css/class.css">


</head>

<body>

    <header>
        <h1>
            <img src="objects/NJO.png">

            <br><br><br><br><br><br>

            Logged in as <a class="name" alt="Student's_name"><u><?php echo $row['fullName']?> </u></a>
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
    <?php
   
	while ($rowC = $returnC->fetchArray(SQLITE3_ASSOC)){

    echo '<button class="classbtn" id="myBtn"><b><font size="5">'.$rowC['classTitle'].'</font><br><br>DUE BY: </b>' .$rowC['dueDate'].' </button>';
  }
    ?>


    <center>

        <div id="myModal" class="modal">
            <div class="modal-content">
                <form action="student.php" method="POST">
                    <span class="close">&times;</span>
                    <input type="text" placeholder="Enter Code" id="code" name="code" />
                    <div class="clearfix">
                        <button type="submit" class="joinbtn" id="btn" value="Join"
                            onclick="classroom.php"><a>Join</a></button>
                    </div>
                </form>
            </div>
        </div>
    </center>



    <script src="javascripts/two.js"></script>
</body>

</html>