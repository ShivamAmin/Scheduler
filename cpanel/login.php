<?php
  //Start session if session doesn't exist.
  if (session_id() === '') {
    session_start();
  }
  $wrong = 0;
  //Validate Password
  if (isset($_POST['password'])) {
    if ($_POST['password'] == 'h?Wf9_N%6AWE?qBx') {
      $_SESSION['valid'] = True;
    } else {
      $wrong = 1;
    }
  }
  //If password is validated, reload cpanel.
  if(isset($_SESSION['valid'])) {
    $newURL = "//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
    $newURL = substr($newURL, 0, strrpos($newURL, '/'));
    header('Location: '.$newURL);
    die();
  }
?>
<link rel="stylesheet" href="css/style.css">
<div class="page">
  <div class="form">
    <form class="login-form" method="post">
      <input type="password" name="password" placeholder="Password"/>
      <input type="submit" value="Submit">
      <?php if ($wrong) { echo 'Wrong Password!'; } ?>
    </form>
  </div>
</div>
