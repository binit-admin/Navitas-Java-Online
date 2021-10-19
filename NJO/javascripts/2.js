  

function one()
{
var modal = document.getElementsByClassName('modal');

var btn = document.getElementById('button2class');

var close = modal.getElementsByClassName('close')[0];

btn.onclick = function() {

  modal.style.display = 'block';
};

close.onclick = function() {

  modal.style.display = 'none';
};

window.onclick = function(event) {

  if (event.target == modal) {
  
  modal.style.display = 'none';
 
}
};
}


var modal = document.getElementsByClassName('modal')[0];
var btn = document.getElementById('button2Class');
var btn = document.getElementsByClassName('open-modal');
var close = modal.getElementsByClassName('close')[0];


btn.onclick = function two() {

  modal.style.display = 'block';
};

close.onclick = function() {

  modal.style.display = 'none';
};

window.onclick = function(event) {

  if (event.target == modal) {
  
  modal.style.display = 'none';

}
};


