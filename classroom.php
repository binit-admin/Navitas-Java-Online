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
<title>  Classroom </title>


<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/classstyle.css">
<script src="javascripts/textbox.js" type="text/javascript" charset="utf-8"></script>
    <script>
          $var editor = ace.edit("editor");
          editor.setTheme("ace/theme/monokai");       
          editor.session.setMode("ace/mode/java");
 </script>

</head>

<body>
     
  <div class="headers">
    <h1><img src="objects/NJO.png" alt="NJO" />
    <h2>Navitas Java Online<h2> </h1>
</div>
<hr class="rounded">
<h4>Logged in as <a class="name" alt="Student's_name"href="#"><u><?php echo $row['fullName']?> </u></a></h4>
    <h3> <b>Classroom </h3>
    <header>Coding Problem</header>
    <div class="question" type ="textbox">
        <p> (to be imported from database).....</p>
      </div>

  <form id="editor">
    <header class="editorheader"><U> ANSWER: </u><u><button class="runbtn">Run>>></button></u></header>
            <textarea id="demo" rows="20" cols="144"></textarea>
        <button type="submit" value="RUN" class="submitbtn">Submit</button>
  </form>

 
  <aside id="output" >
    <header><U> OUTPUT</U> AND <U>INPUT</U> (if any) </header>
            
          
</aside>
  
  


</body>
</html>