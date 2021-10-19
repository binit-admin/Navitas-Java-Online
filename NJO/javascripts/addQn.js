function go(){
 var buttons = document.getElementsByClassName('containers');
//var open = document.getElementById("myForm")[0];
var open = document.getElementsByClassName('form-popup')[0];
var i = 0;

for (var i = 0, len = buttons.length; i < len; i++) {

    buttons[i].onclick = function open2() {
  open.style.display = "block";
};

function closeForm() {
  open.style.display = "none";
};
    }};
 


    