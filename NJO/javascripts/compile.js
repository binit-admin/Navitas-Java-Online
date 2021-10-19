$codeIn= "public class SumOfNumbers1\r\n{  \r\npublic static void main(String args[])   \r\n{  \r\nint n1 = 225, n2 = 115, sum;  \r\nsum = n1 + n2;  \r\nSystem.out.println(\"The sum of numbers is: \"+sum);  \r\n}  \r\n}";

var run = document.getElementById("runbtn");

var request = require('request');

    run.addEventListener("click", function(e) {
        e.preventDefault();

        var codeIn = document.getElementById("editor");

        var credits = document.getElementById("credits");
        var output = document.getElementById("output");

        output.innerHTML = "Compiling...";

        console.log('statusCode:', response && response.status);
        console.log("Credits-Left: " + 167);

 
var program = { 
    script: codeIn,
    language: "java",
    versionIndex: "3",
    clientId: "f09ff16aed0322f99d5051c1076667b5",
    clientSecret: "36bbfab973fb73461c12dcb4acaf90e3896e687e563845ddfc10444756e1516e"
};
  
run.request(
    {
    url: 'https://api.jdoodle.com/v1/execute',
    method: "POST",
    json: program 
},

function (error, response, body)
 { 
     console.log('error:', error);
     console.log('statusCode:', response && response.statusCode);
      
    
     let json = JSON.parse(body);
    console.log(json);
})
    });

    