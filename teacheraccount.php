<?php

session_start();
    require_once("connection.php");
    require_once("function.php");

    
    //connection to account table fro auto-generated form
    $email= $_SESSION['email'];
	$sqlTA1 =<<<EOF
		SELECT * from account
		WHERE email='$email';
	
	EOF;
	
	$returnTA1 = $db->query($sqlTA1);
	$row = $returnTA1->fetchArray(SQLITE3_ASSOC);

  //if empty address & course, (add) else (update)
  
	
    if ($_SERVER['REQUEST_METHOD'] == "POST" &&  isset($_POST['submit']))
    //account form inputs
    {
        $fullName= $_POST['name'];
		    $email = $_POST['email'];
        $dateOfBirth = $_POST['dateOfBirth'];
        $field = $_POST['field'];
        $contact = $_POST['contact'];

        $account = $row['accountID'];

              $sqlTA3 =<<<EOF
          SELECT * from teacher
          WHERE email='$email';
        
        EOF;
        
        $returnTA3 = $db->query($sqlTA3);
        $row3 = $returnTA3->fetchArray(SQLITE3_ASSOC);
     
      
//existing contact and field then update
        if (empty($row3)){
              $staffID = random(7);
                      $sql_TA =<<<EOF

                      INSERT INTO teacher (staffID, accountID, name, email, dateOfBirth, field, contactNum) 
                      VALUES ('$staffID',$account, '$fullName', '$email','$dateOfBirth', '$field', '$contact');
                    EOF;
                        $return_TA = $db->exec($sql_TA);
                    

                        if($return_TA)
                        {
                        sleep(2);
                        echo '<i>Account updated Successfully</i>'.'<br>';
                        }
                        else{
                        echo 'Error in Updating Account!!'.'<br>';
                            }
          

        }
       //add field and contact for the first time
        else
       {
        $sqlUp =<<<EOF
            UPDATE teacher SET dateOfBirth= '$dateOfBirth', field='$field', contactNum ='$contact', name ='$fullName'
            WHERE email='$email';
            ;
    
          EOF;
            $return_T = $db->exec($sqlUp);
            
            if($return_T)
            {
              echo '<i>Data Updated for Existing Teacher</i>.';

            }
            else
            {
              echo "Error to Update Details";
            }

        }
    
   
 } 
      //read from the updated databse to display for the next page load
      $sqlTA2 =<<<EOF
        SELECT * from teacher
        WHERE email= '$email';
    
      EOF;
        
        $returnTA2 = $db->query($sqlTA2);
        $rowTA2 = $returnTA2->fetchArray(SQLITE3_ASSOC);


?>


<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" href="css/stdaccount.css">

</head>
<body>

<h2>Update Your Details</h2>

<div class="container">
  <form action="teacheraccount.php" method="POST">
  <div class="row">
    <div class="col-25">
      <label for="fname"> Full Name</label>
    </div>
    <div class="col-75">
      <input type="text" id="fname" name="name" value="<?php  if ($rowTA2)
                                                            {
                                                              echo $rowTA2['name'];
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
      <input type="text" id="email" name="email" value="<?php echo $row['email']?>" readonly> 
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="DateOfBirth"> Date of Birth</label>
    </div>
    <div class="col-75">
        <input type="text" id="dob" name="dateOfBirth" value="<?php  if ($rowTA2)
                                                            {
                                                              echo $rowTA2['dateOfBirth'];
                                                            }
                                                            else echo $row['dateOfBirth'];
                                                        ?>"> 
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="feild">Field</label>
    </div>
    <div class="col-75">
      <input type="text" id="field" name="field" value="<?php  if ($rowTA2)
                                                            {
                                                              echo $rowTA2['field'];
                                                            }
                                                            else echo '';
                                                        ?>" required>
    </div>
  </div>

  <div class="row">
    <div class="col-25">
      <label for="contact"> Contact</label>
    </div>
    <div class="col-75">
      <input type="text" id="contact" name="contact"  value="<?php  if ($rowTA2)
                                                            {
                                                              echo $rowTA2['contactNum'];
                                                            }
                                                            else echo '';
                                                        ?>" required>
    </div>
  </div>
  <div class="row">
      <br>
    <input type="submit" value="Update" name="submit">
  </div>
  </form>
</div>

</body>
</html>
