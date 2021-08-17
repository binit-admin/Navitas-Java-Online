<?php



function check_login($row)
{

	 if(isset($_SESSION['email']))
	 {
		 require_once["connection.php"];

		 $sql4 =<<<EOF
		SELECT * from account
		WHERE email= '$email';

	EOF;
		
		$return4 = $db->query($sql4);
		$row = $return4->fetchArray(SQLITE3_ASSOC);
			 return $row;

			 if($row['account_type']="Student")
				{
					header("Location: student.php");
				}
				elseif($row['account_type']="Lecturer")
				{
					header("Location: teacher.php");
				}
				else echo "Error- Account Type: Unidentified";
		
	 }
	 //Redirect to home
	 
	
}

function random($length)
{

	$text = "";
	if ($length < 5)
	{
		$length = 5;
	}

	$len = rand( 4, $length);

	for ( $i = 0; $i < $len; $i++)
	{
		$text .= rand(0,9);

	}
	return $text;
}


