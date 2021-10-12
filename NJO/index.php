<?php

session_start();

include ("connection.php");

//registration
	if ($_SERVER['REQUEST_METHOD'] == "POST" &&  isset($_POST['register']))
	{
		//if posted
		$fullName= $_POST['fullName'];
		$dateOfBirth = $_POST['dateOfBirth'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$confirmPswd= $_POST['confirmPswd'];
		$account_type = $_POST['account_type'];
		$password_hash = password_hash($password, PASSWORD_BCRYPT);
		$password_hash = password_hash($confirmPswd, PASSWORD_BCRYPT);
		
		$error='';

		$sql1 =<<<EOF
		SELECT * from account
		WHERE email= '$email';

	EOF;
		
		$return = $db->query($sql1);
		$row = $return->fetchArray(SQLITE3_ASSOC);
		if($row)
			{
//check if account is already registered into the database
			
			$mail= '['.$email.']';
			$error .=$mail.'<i> Account is already registered, please login</i>'.'<br>';
			$db->close();
			}

		else{
//check if the password is less than 7 characters and other form entry errors!!!
			if( strlen($password) < 7)
				{
					$error .='PASSWORD must have atleast 7 characters'.'<br>';
				}
			if(empty($email)  && empty($account_type) && empty($fullName) && empty($dateOfBirth))
				{
					$error .= 'Please enter all information to REGISTER'.'<br>';
				}
			if(empty($password) || empty($confirmPswd))
				{
					$error .= 'PASSWORD must be entered'.'<br>';
				}
			else
				{
				if ($confirmPswd!=$password)
				{
					$error .= 'Password did not match';
				}
				
//saving to the Database straight from website
				if (empty($error))
					{
				require_once ("function.php");	
				$user_ID = random(10);
				$sql =<<<EOF
				
				INSERT INTO account (user_ID, fullName, dateOFBirth, email, password, confirmPswd, account_type) 
				VALUES ('$user_ID', '$fullName', '$dateOfBirth', '$email', '$password', '$confirmPswd', '$account_type');
			EOF;
				  $return1 = $db->exec($sql);

				  if($return1)
				  {
					sleep(2);
					$error .= 'Registration Successful, please login'.'<br>';
				  }
				  else{
					$error .= 'Error in Registering New Account!!'.'<br>';
				  		}
					}

				}		 
		}echo $error;
		//header("location: index.php");
	}
		
		 
		
	
//for login, to validate details
elseif ($_SERVER['REQUEST_METHOD'] == "POST" &&  isset($_POST['submit']))
{
	
	$email = $_POST['email'];
	$password = $_POST['password'];
	$password_hash = password_hash($password, PASSWORD_BCRYPT);

	$error='';

	if (empty($email))
	{
		$error .= 'Please enter the Email'.'<br>'; 
	}
	if (empty($password))
	{
		$error .= 'Please enter the password'.'<br>'; 
	}
	//main
	if(empty($error))
	{			
		$sql2 =<<<EOF
		SELECT * from account
		WHERE email='$email';
	
	EOF;
	
	$return2 = $db->query($sql2);
	$row = $return2->fetchArray(SQLITE3_ASSOC);		
	
			if($row)
			{
				if ($password==$row['password'] && $email == $row["email"])
				//=$email && $row['password']= $password
				{
						
					echo 'LOGGING IN...';
		
				if($row['account_type']=="Lecturer")
				{
					header("Location: teacher.php");
					$_SESSION['email']=$email;
				}
				elseif($row['account_type']=="Student")
				{
					$_SESSION['email']=$email;
					header("Location: student.php");
					
				}
				else echo "Error- Account Type: Unidentified";
		
				}
			
				else $error .="incorrect password!!!".'<br>';
			}

			else
			$error .='Email is not yet registered, Please register'.'<br>';
	}
	
	else
	{
		echo'Unfortunately, login is unsuccessful';
	}

	echo $error;
	
  }
  
  

 

 
?>

<!DOCTYPE html> 
<html>
<head>

	<title> Navitas Java Online </title>
<script src="javascripts/one.js" charset="UTF-8"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/1style.css">

</head>
<body>
	
	<h2> Navitas Java Online</h2>
<div class="container" id="container">
	<div class="form-container sign-up-container">

	<form action="index.php" method="POST" >
			<h1>Register</h1>
			
			<input type="text" placeholder="Name" name= "fullName"required/>
			<input type="email" placeholder="Email" name = "email" required/>
			<input type="password" placeholder="Password" name = "password" required/>
			<input type="password" placeholder="Re-Enter Password" name= "confirmPswd" required/>
			<input type="dob" placeholder="Date of Birth: (yyyy/mm/dd)" name= "dateOfBirth" required />
			<input type="text" placeholder="Student/Lecturer" name = "account_type" required/>
		
			<button id="register" type="register" name="register">REGISTER<br></button>
			
		</form>

	</div>
	<div class="form-container sign-in-container">
		<form action="index.php" method="POST">
			<h1>Please Login</h1>
			
			<input type="email" placeholder="Email" name="email"  required/>
			<input type="password" placeholder="Password" name="password" required />
			<a href="#">Forgot your password?</a>
			<button href="classroom.php" id="submit" name="submit">Login</button>
		</form>

	</div>
	<div class="overlay-container" onclick="slide()">
		<div class="overlay">
			<div class="overlay-panel overlay-left">
				<h1>Welcome Back!</h1>
				<p>To keep connected with us please login with your deatils</p>
				<button class="ghost" id="signIn" onclick="slide()">Please Login</button>
			</div>
			<div class="overlay-panel overlay-right">
				<h1>Hello !!!</h1>
				<p>Enter your personal details and login to start CODING</p>
				<button class="ghost" id="signUp" onclick="slide()">Sign Up</button>
			</div>
		</div>
	</div>
</div>

</body>
</html>

