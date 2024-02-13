<?php
  //Start session if session doesn't exist.
  if (session_id() === '') {
    session_start();
  }
  //If session is validated, load cpanel. If not, load login page.
  if(isset($_SESSION['valid'])){
    require('cpanel.php');
  } else {
    require('login.php');
  }
?>
