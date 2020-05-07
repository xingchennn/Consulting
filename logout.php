
<?php session_start();?>
<?php


// if there is session, log it out and destroy
if (count($_SESSION) > 0)    
{   
   foreach ($_SESSION as $key => $value)
   {	
      unset($_SESSION[$key]);
   }      
   session_destroy();     

   header('Location: get_list.php');
}
?>
