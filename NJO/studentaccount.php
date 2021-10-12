<?php

session_start();
    require_once("connection.php");
    require_once("function.php");

    
    //connection to account table fro auto-generated form
    $email= $_SESSION['email'];
	$sqlSA1 =<<<EOF
		SELECT * from account
		WHERE email='$email';
	
	EOF;
	
	$returnSA1 = $db->query($sqlSA1);
	$row = $returnSA1->fetchArray(SQLITE3_ASSOC);

  //if empty address & course, (add) else (update)
  
	
    if ($_SERVER['REQUEST_METHOD'] == "POST" &&  isset($_POST['register']))
    //account form inputs
    {
        $fullName= $_POST['name'];
		    $email = $_POST['email'];
        $dateOfBirth = $_POST['dateOfBirth'];
        $address = $_POST['address'];
        $course = $_POST['course'];

        $account = $row['accountID'];

              $sqlSA3 =<<<EOF
          SELECT * from student
          WHERE email='$email';
        
        EOF;
        
        $returnSA3 = $db->query($sqlSA3);
        $row3 = $returnSA3->fetchArray(SQLITE3_ASSOC);
     
      
//existing address and course then update
        if (empty($row3)){
              $studentID = random(7);
                      $sql_SA =<<<EOF

                      INSERT INTO student (studentID, accountID, name, email, dateOfBirth, address, course) 
                      VALUES ('$studentID',$account, '$fullName', '$email','$dateOfBirth', '$address', '$course');
                    EOF;
                        $return_SA = $db->exec($sql_SA);
                    

                        if($return_SA)
                        {
                        sleep(2);
                        echo '<i>Account updated Successfully</i>'.'<br>';
                        }
                        else{
                        echo 'Error in Updating Account!!'.'<br>';
                            }
          

        }
       //add course and address for the first time
        else
       {
        $sqlUp =<<<EOF
            UPDATE student SET dateOfBirth= '$dateOfBirth', address='$address', course ='$course', name ='$fullName'
            WHERE email='$email';
            ;
    
          EOF;
            $return_S = $db->exec($sqlUp);
            
            if($return_S)
            {
              echo '<i>Data Updated for Existing Student</i>.';

            }
            else
            {
              echo "Error to Update Details";
            }

        }
    
   
 } 
      //read from the updated databse to display for the next page load
      $sqlSA2 =<<<EOF
        SELECT * from student
        WHERE email= '$email';
    
      EOF;
        
        $returnSA2 = $db->query($sqlSA2);
        $rowSA2 = $returnSA2->fetchArray(SQLITE3_ASSOC);


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
      <input type="text" id="fname" name="name" value="<?php  if ($rowSA2)
                                                            {
                                                              echo $rowSA2['name'];
                                                            }
                                                            else echo $row['fullName'];
                                                        ?>">
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="email">Email Address</label>
    </div>
    <div class="col-75">
      <input type="text" id="email" name="email" value="<?php echo $row['email'];?>" readonly> 
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="DateOfBirth"> Date of Birth</label>
    </div>
    <div class="col-75">
        <input type="text" id="dob" name="dateOfBirth" value="<?php  if ($rowSA2)
                                                            {
                                                              echo $rowSA2['dateOfBirth'];
                                                            }
                                                            else echo $row['dateOfBirth'];
                                                        ?>"> 
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="address">Address</label>
    </div> 
    
    <div class="col-75">
      <input type="text" id="address" name="address" value="<?php  if ($rowSA2)
                                                            {
                                                              echo $rowSA2['address'];
                                                            }
                                                            else echo '';
                                                        ?>" required>
    </div>
  </div>

  <div class="row">
    <div class="col-25">
      <label for="course"> Course</label>
    </div>
    <div class="col-75">
      <input type="text" id="course" name="course" value="<?php  if ($rowSA2)
                                                            {
                                                              echo $rowSA2['course'];
                                                            }
                                                            else echo '';
                                                        ?>" required>
    </div>
  </div>
  <br>
  <div class="row">
    <input type="submit" value="Update" name="register"> 
  </div>
  </form>
</div>

</body>
</html>

 