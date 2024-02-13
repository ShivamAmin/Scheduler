<?php
  //Start session if session doesn't exist.
  if (session_id() === '') {
    session_start();
  }
  //unvalidate session
  if(isset($_POST['Logout'])) {
    unset($_SESSION['valid']);
  }
  //If session is not valid, reload cpanel
  if(!isset($_SESSION['valid'])) {
    $newURL = "//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
    $newURL = substr($newURL, 0, strrpos($newURL, '/'));
    header('Location: '.$newURL);
    die();
  }

  //Database settings
  define('DB_USER', 'shivamam_Scheduler_Admin');
  define('DB_PASSWORD', 'r!b.+0n;oJr4');
  define('DB_HOST', 'localhost');
  define('DB_NAME', 'shivamam_SchedulerDB');

  // Make the connection:
  $dbc = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die('Could not connect to MySQL: ' . mysqli_connect_error());

  // Set the encoding...
  mysqli_set_charset($dbc, 'utf8');

  $q = '';

  //Execute command depending on button clicked
  if(isset($_POST['Search'])) {
    search();
  } else if(isset($_POST['Reset'])) {
    resetForm();
  } else if(isset($_POST['Delete'])) {
    deleteData();
  } else if(isset($_POST['Submit'])) {
    submit();
  } else if(isset($_POST['Update'])) {
    update();
  }
  //search database using primary key(s)
  function search() {
    global $q;
    $q = 'select * from ' .$_POST['table']. ' where cRefNum='.$_POST['cRefNum'];
    if ($_POST['table'] == 'teachers') {
      $q = $q.' and teacherNumber='.$_POST['teacherNumber'];
    } else if ($_POST['table'] == 'courseTimes') {
      $q = $q.' and cMeetTimeID='.$_POST['cMeetTimeID'];
    }
    $q = $q.';';
  }

  //reset cpanel
  function resetForm() {
    //Form Reset
  }

  //delete record(s) from database
  function deleteData() {
    global $dbc, $q;
    $q = 'delete from '.$_POST['table'].' where cRefNum='.$_POST['cRefNum'];
    if($_POST['table'] == 'teachers') {
      $q = $q.' and teacherNumber='.$_POST['teacherNumber'];
    } else if($_POST['table'] == 'courseTimes') {
      $q = $q.' and cMeetTimeID='.$_POST['cMeetTimeID'];
    }
    $q = $q.';';
    @mysqli_query($dbc, $q);
  }

  //insert record into database
  function submit() {
    global $dbc, $q;
    $count = count($_POST) - 1;
    $x = 0;
    $keys = '';
    $values = '';
    foreach ($_POST as $key => $value) {
      $x = $x + 1;
      if($value != ''){
        if ($value != $_POST['table'] && $count + 1 != $x){
          $keys = $keys.$key;
          if(!($key == 'cRefNum' || $key == 'cCode' || $key == 'cTermYear' || $key == 'cCredits' || $key == 'cFirstMeetTimeID' || $key == 'cSecondMeetTimeID' || $key == 'teacherNumber' || $key == 'cMeetTimeID')) {
            $values = $values.'\''.$value.'\'';
          } else {
            $values = $values.$value;
          }
          if($count != $x) {
            $keys = $keys.', ';
            $values = $values.', ';
          }
        }
      } else {
        if ($value != $_POST['table'] && $count + 1 != $x){
          $keys = $keys.$key;
          $values = $values.'\'\'';
          if($count != $x) {
            $keys = $keys.', ';
            $values = $values.', ';
          }
        }
      }
    }
    $q = 'insert into ' .$_POST['table']. ' ('.$keys.') values ('.$values.');';
    @mysqli_query($dbc, $q);
  }

  //update database record with new information
  function update() {
    global $dbc, $q;
    $count = count($_POST) - 1;
    $x = 0;
    if(isset($_POST['Update'])) {
      $q = 'update '.$_POST['table'].' set ';
      foreach ($_POST as $key => $value) {
        $x++;
        if($value != $_POST['table'] && $key != 'cRefNum' && $key != 'teacherNumber' && $key != 'cMeetTimeID' && $count + 1 != $x){
          if(!($key == 'cRefNum' || $key == 'cCode' || $key == 'cTermYear' || $key == 'cCredits' || $key == 'cFirstMeetTimeID' || $key == 'cSecondMeetTimeID' || $key == 'teacherNumber' || $key == 'cMeetTimeID')) {
            $q = $q.' '.$key.'=\''.$value.'\'';
          } else {
            $q = $q.' '.$key.'='.$value;
          }
          if($count != $x) {
            $q = $q.', ';
          }
        }
      }
      $q = $q.' where cRefNum='.$_POST['cRefNum'];
      if($_POST['table'] == 'teachers') {
        $q = $q.' and teacherNumber='.$_POST['teacherNumber'];
      } else if($_POST['table'] == 'courseTimes') {
        $q = $q.' and cMeetTimeID='.$_POST['cMeetTimeID'];
      }
      $q = $q.';';
    }
    @mysqli_query($dbc, $q);
  }

  //read data from record in database
  function getData($table, $field) {
    global $dbc, $q;
    if(isset($_POST['Search'])) {
      $r = @mysqli_query($dbc, $q);
      while ($row = mysqli_fetch_array($r)) {
        if($_POST['table'] == $table) {
          if(isset($row[$field])) {
            if(($field == 'cFirstMeetTimeID' or $field == 'cSecondMeetTimeID') && ($row[$field] == 1 or $row[$field] == 2)) {
              echo 'checked="checked"';
            } else {
              echo $row[$field];
            }
          }
        }
      }
    }
  }

  //determine if data is being inserted or updated.
  function buttonType($table) {
    if (isset($_POST['table'])) {
      if ($_POST['table'] == $table) {
        if (isset($_POST['Search'])) {
          echo 'name="Update" value="Update"';
        } else {
          echo 'name="Submit" value="Submit"';
        }
      } else {
        echo 'name="Submit" value="Submit"';
      }
    } else {
      echo 'name="Submit" value="Submit"';
    }
  }

  //determine if button is readonly or not
  function isReadOnly($table) {
    if (isset($_POST['table'])) {
      if ($_POST['table'] == $table) {
        if (isset($_POST['Search'])) {
          echo 'readonly';
        }
      }
    }
  }
?>
<html>
  <head>
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    <div class="page">
        <div class="form">
            <form method="post" class="form-form">
                <div class="title">Course Details</div>
                <input type="hidden" name="table" value="courseDetails" />
                <div class="left">
                    <input type="text" name="cRefNum" placeholder="Reference Number" value="<?php getData('courseDetails', 'cRefNum'); ?>" required <?php isReadOnly( 'courseDetails') ?>/>
                </div>
                <div class="right">
                    <input type="submit" name="Search" value="Search" class="search-btn" />
                </div>
                <input type="text" name="cName" placeholder="Name" value="<?php getData('courseDetails', 'cName'); ?>" />
                <input type="text" name="cProgram" placeholder="Program" value="<?php getData('courseDetails', 'cProgram'); ?>" />
                <input type="text" name="cCode" placeholder="Code" value="<?php getData('courseDetails', 'cCode'); ?>" />
                <input type="text" name="cSection" placeholder="Section" value="<?php getData('courseDetails', 'cSection'); ?>" />
                <input type="text" name="cTerm" placeholder="Term" value="<?php getData('courseDetails', 'cTerm'); ?>" />
                <input type="text" name="cTermYear" placeholder="Year" value="<?php getData('courseDetails', 'cTermYear'); ?>" />
                <input type="text" name="cGradeMode" placeholder="Grade Mode" value="<?php getData('courseDetails', 'cGradeMode'); ?>" />
                <input type="text" name="cCredits" placeholder="Credits" value="<?php getData('courseDetails', 'cCredits'); ?>" />
                <input type="text" name="cLevel" placeholder="Level" value="<?php getData('courseDetails', 'cLevel'); ?>" />
                <input type="text" name="cCampus" placeholder="Campus" value="<?php getData('courseDetails', 'cCampus'); ?>" />
                <div class="left3">First Meet Time ID</div>
                <div class="right3"> <input type="hidden" name="cFirstMeetTimeID" value="0" /><input type="checkbox" name="cFirstMeetTimeID" value="1" <?php getData( 'courseDetails', 'cFirstMeetTimeID'); ?>/></div>
                <div class="left3">Second Meet Time ID</div>
                <div class="right3"><input type="hidden" name="cSecondMeetTimeID" value="0" /><input type="checkbox" name="cSecondMeetTimeID" value="2" <?php getData( 'courseDetails', 'cSecondMeetTimeID'); ?>/></div>
                <div class="bottom">
                    <div class="left">
                        <input type="submit" name="Delete" value="Delete" />
                    </div>
                    <div class="middle">
                        <input type="submit" name="Reset" value="Reset" />
                    </div>
                    <div class="right">
                        <input type="submit" <?php buttonType( 'courseDetails'); ?>/>
                    </div>
                </div>
            </form>
        </div>
        <div class="form">
            <form method="post" class="form-form">
              <div class="title">Teachers</div>
                <input type="hidden" name="table" value="teachers" />
                <input type="text" name="teacherNumber" placeholder="Teacher ID" value="<?php getData('teachers', 'teacherNumber'); ?>" required <?php isReadOnly( 'teachers') ?>/>
                <div class="left">
                    <input type="text" name="cRefNum" placeholder="CRN" required value="<?php getData('teachers', 'cRefNum'); ?>" <?php isReadOnly( 'teachers') ?>/>
                </div>
                <div class="right">
                    <input type="submit" name="Search" value="Search" />
                </div>
                <input type="text" name="fname" placeholder="First Name" value="<?php getData('teachers', 'fname'); ?>" />
                <input type="text" name="mname" placeholder="Middle Name" value="<?php getData('teachers', 'mname'); ?>" />
                <input type="text" name="lname" placeholder="Last Name" value="<?php getData('teachers', 'lname'); ?>" />
                <input type="tel" name="telephone" placeholder="Telephone" value="<?php getData('teachers', 'telephone'); ?>" />
                <input type="email" name="email" placeholder="Email" value="<?php getData('teachers', 'email'); ?>" />
                <div class="bottom">
                    <div class="left">
                        <input type="submit" name="Delete" value="Delete" />
                    </div>
                    <div class="middle">
                        <input type="submit" name="Reset" value="Reset" />
                    </div>
                    <div class="right">
                        <input type="submit" <?php buttonType( 'teachers'); ?>/>
                    </div>
                </div>
            </form>
        </div>
        <div class="form">
            <form method="post" class="form-form">
                <div class="title">Course Times</div>
                <input type="hidden" name="table" value="courseTimes" />
                <div class="left2">
                    <input type="radio" name="cMeetTimeID" value="1" id="One" checked="checked" /><label for="One">One</label>
                </div>
                <div class="right2">
                    <input type="radio" name="cMeetTimeID" value="2" id="Two" /><label for="Two">Two</label>
                </div>
                <div class="left">
                    <input type="text" name="cRefNum" placeholder="CRN" required value="<?php getData('courseTimes', 'cRefNum'); ?>" <?php isReadOnly( 'courseTimes') ?>/>
                </div>
                <div class="right">
                    <input type="submit" name="Search" value="Search" />
                </div>
                <input type="text" name="cType" placeholder="Type" value="<?php getData('courseTimes', 'cType'); ?>" />
                <input type="text" name="cTimeStart" placeholder="Time Start" value="<?php getData('courseTimes', 'cTimeStart'); ?>" />
                <input type="text" name="cTimeEnd" placeholder="Time End" value="<?php getData('courseTimes', 'cTimeEnd'); ?>" />
                <input type="text" name="cDay" placeholder="Day" value="<?php getData('courseTimes', 'cDay'); ?>" />
                <input type="text" name="cCampus" placeholder="Campus" value="<?php getData('courseTimes', 'cCampus'); ?>" />
                <input type="text" name="cBuildingSection" placeholder="Building Section" value="<?php getData('courseTimes', 'cBuildingSection'); ?>" />
                <input type="text" name="cRoom" placeholder="Room" value="<?php getData('courseTimes', 'cRoom'); ?>" />
                <div class="left3 text">Date Start</div>
                <div class="right3">
                    <input type="date" name="cDateStart" value="<?php getData('courseTimes', 'cDateStart'); ?>" />
                </div>
                <div class="left3 text">Date End</div>
                <div class="right3">
                    <input type="date" name="cDateEnd" value="<?php getData('courseTimes', 'cDateEnd'); ?>" />
                </div>
                <div class="bottom">
                    <div class="left">
                        <input type="submit" name="Delete" value="Delete" />
                    </div>
                    <div class="middle">
                        <input type="submit" name="Reset" value="Reset" />
                    </div>
                    <div class="right">
                        <input type="submit" <?php buttonType( 'courseTimes'); ?>/>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <button class="prev" onclick="slideIndexed(1)">&lt;</button>
    <button class="next" onclick="slideIndexed(9)">&gt;</button>
    <div class="logout">
      <form method="post">
        <input type="submit" name="Logout" value="logout"/>
      </form>
    </div>
    <?php mysqli_close($dbc); ?>
  </body>
  <script src="js/script.js"></script>
</html>
