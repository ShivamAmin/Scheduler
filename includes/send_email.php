<?php
function console_log( $data ){
  echo '<script>';
  echo 'console.log('. json_encode( $data ) .')';
  echo '</script>';
}
console_log($_GET);
$studentName = $_GET['yourName'];
$studentEmail = $_GET['yourEmail'];
$studentMessage = $_GET['yourMessage'];
$teacherName = $_GET['emailTeacher'];
if($teacherName != "humberschedulerapp@gmail.com") {
  $teacherName = $teacherName . explode(" - ", $teacherName);

  require("includes/databaseConection.php");

  // Make the connection:
  $dbc = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die('Could not connect to MySQL: ' . mysqli_connect_error());

  // Set the encoding...
  mysqli_set_charset($dbc, 'utf8');

  $q = "SELECT email FROM `teachers` WHERE CONCAT(fname,' ',lname) = " + $teacherName;
  $r = @mysqli_query($dbc, $q);

  $teacherEmail = $r['email'];

  $to = $teacherEmail;
  $subject = "New Message from student: " + $studentName;
  $message = $studentMessage;
} else {
  $to = $teacherName;
  $subject = "New Question!";
  $message = $studentMessage;
  $studentEmail = "Anon";
}

$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

$headers .= "From <" . $studentEmail . ">" . "\r\n";

mail($to, $subject, $message, $headers);
