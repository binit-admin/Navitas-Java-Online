<?php
session_start();
    require_once("connection.php");
   $s;
    //for user

    $email= $_SESSION['email'];
	$sql3 =<<<EOF
		SELECT * from account
		WHERE email='$email';
	
	EOF;
	
	$return3 = $db->query($sql3);
	$row = $return3->fetchArray(SQLITE3_ASSOC);

//for class reference
$sql =<<<EOF
		SELECT * from classroom;
	
	EOF;
	
	$return = $db->query($sql);
	$row1 = $return->fetchArray(SQLITE3_ASSOC);
if ($row1){
    $y = $row1['classID'];
}
    
    //for accessing question in the particular class
$sql2 =<<<EOF
    SELECT * from question
    WHERE respClassID = '$y';
EOF;
        
        $return2 = $db->query($sql2);
        $row2 = $return2->fetchArray(SQLITE3_ASSOC);

        if ($row2)
        {
            $s = $row2['questionDesc'];
        }
        else{
            echo 'No Qn added yet';
        }
 
?>



<!DOCTYPE html>
<html>

<head>
    <title> Classroom </title>
    <style type="text/css" media="screen">
    #editor {
        position: relative;
        top: 10;
        right: 50%;
        bottom: 10;
        left: 0;
        height: 300px;
        width: 100%;
    }
    </style>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/classstyle.css">


</head>

<body>

    <div class="headers">
        <h1><img src="objects/navitas.jpeg" alt="NJO" />
            <br><br><br><br>
            Logged in as <a class="name" alt="Student's_name" href="#"><u><?php echo $row['fullName']?> </u></a>
        </h1>
        <br>
        <ul>
            <li><a href="student.php">Home</a></li>
            <li><a href="studentgradesheet.php">Grades</a></li>
            <li><a href="resources.php">Resources</a></li>
            <li><a href="studentaccount.php">Account</a></li>
            <li><a href="https://navitas.com">About</a></li>
        </ul>

    </div>
    <hr class="rounded">
    <h3> <b>Navitas Java Online</h3>
    <header>Code the following Program!!</header>

    <div class="question" type="textbox"> 

   <p style="padding: 10px"> 

   <?php
//for accessing question in the particular class
$sql2 =<<<EOF
SELECT * from question
WHERE respClassID = '15';
EOF;
    
    $return2 = $db->query($sql2);
    $row2 = $return2->fetchArray(SQLITE3_ASSOC);

    if ($row2)
    {
        $s = $row2['questionDesc'];
        echo $s;
    }
    else{
        echo 'No Qn added yet';
    }
    
    
?>
   </p>
    </div>

    <form method="post" action="classroom.php">
        <header class="editorheader"><u> ANSWER:</u>
            <button class="runbtn" id="runbtn" style="fill: aquamarine; float: right">
                RUN</button></u>
        </header>
        <div id="editor" class="edits" input="text">
            class Swap {
            public static void main(String[] args) {
            int x = 1, y = 0,
            int t;// x and y are to swap


            System.out.println("before swapping numbers: "+x +" "+ y);
            /*swapping */
            t = x;
            x = y;
            y = t;
            System.out.println("After swapping: "+x +" " + y);
            System.out.println( );
            }
            }


        </div>
        <button type="submit" class="submitbtn">SUBMIT</button><br> <br>
    </form>
    <aside type="textbox">
        <header><U> OUTPUT</U> AND <U>INPUT</U> (if any) </header>
        <code id="output">

        </code>
    </aside>
    <script>
    var run = document.getElementById("runbtn");

    run.addEventListener("click", function(e) {
        e.preventDefault();

        var codeIn = document.getElementById("editor");
 
        var credits = document.getElementById("credits");
        var output = document.getElementById("output");

        output.innerHTML =  "0,1";
        //codeIn
        var obj = {};
        obj["clientId"] = "f09ff16aed0322f99d5051c1076667b5";
        obj["clientSecret"] = "36bbfab973fb73461c12dcb4acaf90e3896e687e563845ddfc10444756e1516e";
        obj["script"] ="public class SumOfNumbers1\r\n{  \r\npublic static void main(String args[])   \r\n{  \r\nint n1 = 225, n2 = 115, sum;  \r\nsum = n1 + n2;  \r\nSystem.out.println(\"The sum of numbers is: \"+sum);  \r\n}  \r\n}";
        obj["language"] = "java";
        obj["versionIndex"] = "3";

        const proxyurl = "https://cat-fact.herokuapp.com/";

        const url = "https://api.jdoodle.com/v1/execute";
        fetch(proxyurl + url, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.string
            })
            .then(response => {
                return response.json()
            })
            .then(data => {
                console.log(data);
                var outputStr = data.output;
                console.log(outputStr);
                var formattedOutput = outputStr.replace(/(?:\r\n|\r|\n)/g, '<br>');
                output.innerHTML = formattedOutput;
            })
            .catch(() => console.log("Can’t access " + url + " response. Blocked by browser?"))

        const creditsUrl = "https://api.jdoodle.com/v1/credit-spent";
        fetch(proxyurl + creditsUrl, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.string

            })
            .then(response => {
                return response();
            })
            .then(data => {
                console.log(data);
                var creditsLeft = 200 - data.used;
                console.log(credits);
                credits.innerHTML = "Runs left: " + creditsLeft;
            })
            .catch(() => console.log("Can’t access " + url + " response. Blocked by browser?"));
           
    });
    </script>

    <script src=" https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.11/ace.js" type="text/javascript" charset="utf-8">
    </script>
    <script src="" type="text/javascript" charset="utf-8">
    </script>


    <script>
    var editor = ace.edit("editor");
    editor.setTheme("ace/theme/dracula");
    editor.session.setMode("ace/mode/java");
    </script>
</body>

</html>