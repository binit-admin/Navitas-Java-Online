
var i = 0;
var buttons = document.getElementsByTagName('button');
var close = document.getElementsByClassName('close')[0];
var modal = document.getElementsByClassName('modal')[0];


for (var i = 0, len = buttons.length; i < len; i++) {
  

    buttons[i].onclick = function click(){

            modal.style.display = 'block';
          };
          
          close.onclick = function() {
          
            modal.style.display = 'none';
          };
          
          window.onclick = function(event) {
          
            if (event.target == modal) {
            
            modal.style.display = 'none';
          
          }


    }
}