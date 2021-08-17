
<?php

/**
 * SQLite connnection
 */

class Mydbase extends SQLite3
   {
      function __construct()
      {
         $this->open('data/data.sqlite');
      }
   }

   $db = new Mydbase();
  
        //testing
            if ($db != null)
                echo '';
            else
                echo 'Whoops, could not connect to the SQLite database!';
?>