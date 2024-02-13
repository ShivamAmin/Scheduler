<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Responsive schedule / timetable</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">


    <!--General Style Stylesheet-->
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/tabbed.css">
    <!--Font Awesome Link-->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <!--Comfortaa Font Family Link-->
    <link href='https://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>
    <!--Button Stylesheet-->
    <link rel="stylesheet" href="css/circle_menu.css">
    <!--Modal Stylesheet-->
    <link rel="stylesheet" href="css/modals.css">

</head>
<body>


<div class="tab">

</div>

<div class='centered'>

</div>

<div class='centered' id="Q&A">
    <div id="top">
        <input type="text" id="myInput" onkeyup="updateTable()" placeholder="Type a question to search..">
        <input type="button" id="myButton" value="Submit">
    </div>

    <table id="myTable">
        <tr class="header">
            <th>Questions and Answers</th>
        </tr>
        <?php
        require("includes/databaseConection.php");

        // Make the connection:
        $dbc = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die('Could not connect to MySQL: ' . mysqli_connect_error());

        // Set the encoding...
        mysqli_set_charset($dbc, 'utf8');

        $q = "select * from questions";

        $r = @mysqli_query($dbc, $q);

        while ($row = mysqli_fetch_array($r)) {
            echo "<tr style=\"display:none\">";
            echo "<td>";
            echo "<button class=\"accordion\">";
            echo $row['Question'];
            echo "</button>";
            echo "<div class=\"panel\">";
            echo "<p>";
            echo $row['Answer'];
            echo "</p>";
            echo "</tr>";
            echo "</td>";
        }

        ?>
    </table>
</div>


<!--Class Selection Modal-->
<div id="courseModal" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
        <div class="modal-header">
            <span class="close">&times;</span>
            <h2>Add Courses</h2>
        </div>
        <div class="modal-body">
            <p>Search By Reference Number</p>
            <input type="text" name="searchCRN" class="searchCRN" placeholder="Search CRN Number.."/>
            <p>Search From Dropdown List Below</p>
            <select name="" onchange="" class="minimal" onclick="return false;" id="courseSelect">
                <option name="default" value="default">Select A Course</option>
                <?php

                $q = "select a.cRefNum, cName, CourseDesc, cTimeStart, cTimeEnd, cDay, Campus, Room, cSchedType, Teachers from
(select cRefNum, cName,  CONCAT(cProgram,'-',cCode,'-',cSection) as CourseDesc, cTimeStart, cTimeEnd, cDay, ct.cCampus as Campus, CONCAT(cBuildingSection, cRoom) AS Room, cSchedType from courseDetails cd inner join courseTimes ct using (cRefNum)) a,
(select cRefNum, Group_CONCAT(fname, ' ', lname) as Teachers from teachers group by cRefNum order by cRefNum) b
where a.cRefNum = b.cRefNum;";


                $r = @mysqli_query($dbc, $q);

                require("includes/course.php");
                $courseNum = 0;
                $courses = array();
                $scheduleValues = array();


                while ($row = mysqli_fetch_array($r)) {

                    $day;
                    $timeStart;
                    $timeEnd;

                    switch ($row['cDay']) {
                        case 'M':
                            $day = 0;
                            break;
                        case 'T':
                            $day = 1;
                            break;
                        case 'W':
                            $day = 2;
                            break;
                        case 'R':
                            $day = 3;
                            break;
                        case 'F':
                            $day = 4;
                            break;
                    }

                    $timeStart = date("g:i a", strtotime($row['cTimeStart']));
                    $timeEnd = date("g:i a", strtotime($row['cTimeEnd']));

                    $courses[$courseNum] = new Course($row['cRefNum'], $day, $row['CourseDesc'], $row['cTimeStart'] . '-' . $row['cTimeEnd'], $row['Campus'] . '-' . $row['Room'], $timeStart . ' - ' . $timeEnd, $row['Teachers']);
                    $courseNum++;


                }
                $newCourses = array();
                $count = 0;
                while (count($courses) > 0) {
                    $count += 1;
                    if ($count >= 20) {
                        break;
                    }
                    array_push($newCourses, $courses[0]);
                    unset($courses[0]);
                    $courses = array_values($courses);
                    for ($x = 0; $x < count($courses) - 1; $x++) {
                        if ($newCourses[count($newCourses) - 1]->cRefNum == $courses[$x]->cRefNum) {
                            $newCourses[count($newCourses) - 1]->day2 = $courses[$x]->day;
                            $newCourses[count($newCourses) - 1]->courseTime2 = $courses[$x]->courseTime;
                            $newCourses[count($newCourses) - 1]->courseRoom2 = $courses[$x]->courseRoom;
                            $newCourses[count($newCourses) - 1]->displayTime2 = $courses[$x]->displayTime;
                            unset($courses[$x]);
                        }
                    }
                    $courses = array_values($courses);
                }

                foreach ($newCourses as $val) {
                    echo '<option value=\'schedule.activities.add( %scheduleNum% ,' . $val->day . ',"' . $val->courseDesc . '","' . $val->courseTime . '","' . $val->courseRoom . '","' . $val->displayTime . '","' . $val->teachers;
                    if ($val->day2) {
                        echo '","red");schedule.activities.add( %scheduleNum% ,' . $val->day2 . ',"' . $val->courseDesc . '","' . $val->courseTime2 . '","' . $val->courseRoom2 . '","' . $val->displayTime2 . '","' . $val->teachers;
                    }
                    echo '","red")\' >' . $val->cRefNum . '</option>';
                }


                ?>
            </select>
            <div id="schedSelect">

            </div>
            <div class="flat_btn" onclick="addCourse()">Add Course</div>
        </div>
    </div>
</div>
<!--End Class Selection Modal-->

<!--Contact Teacher Modal-->
<div id="contactModal" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
        <div class="modal-header">
            <span class="close">&times;</span>
            <h2>Contact Teacher</h2>
        </div>
        <div class="modal-body">
            <form id="contact-form">
                <p>Dear </p><select name="email-teacher" onchange="" class="minimal" onclick="return false;"
                                    id="teacherSelect"></select>
                <p>My
                    <label for="your-name">name</label> is
                    <input class="cntIn" type="text" name="your-name" id="your-name" minlength="3"
                           placeholder="(your name here)" required> and
                </p>
                <p>my
                    <label for="email">email address</label> is
                    <input class="cntIn" type="email" name="your-email" id="email" placeholder="(your email address)"
                           required>
                </p>
                <p> I have a
                    <label for="your-message">message</label> for you,</p>
                <p>
                    <textarea name="your-message" id="your-message" placeholder="(your msg here)" class="expanding"
                              required></textarea>
                </p>
                <p>
                    <button id="submitButton">
                        <svg version="1.1" class="send-icn" xmlns="http://www.w3.org/2000/svg"
                             xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="100px" height="36px"
                             viewBox="0 0 100 36" enable-background="new 0 0 100 36" xml:space="preserve">
        <path d="M100,0L100,0 M23.8,7.1L100,0L40.9,36l-4.7-7.5L22,34.8l-4-11L0,30.5L16.4,8.7l5.4,15L23,7L23.8,7.1z M16.8,20.4l-1.5-4.3
	l-5.1,6.7L16.8,20.4z M34.4,25.4l-8.1-13.1L25,29.6L34.4,25.4z M35.2,13.2l8.1,13.1L70,9.9L35.2,13.2z"/>
      </svg>
                        <small>send</small>
                    </button>
                </p>
            </form>
        </div>
    </div>
</div>
<!--End Contact Teacher Modal-->


<!--Export Modal-->
<div id="exportModal" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
        <div class="modal-header">
            <span class="close">&times;</span>
            <h2>Import or Export Schedule</h2>
        </div>
        <div class="modal-body">
            <div class="flat_btn">Import XML<input type='file' accept='text/xml' onchange='openFile(event)'
                                                   style="opacity: 0.0; position: absolute; top:0; left: 0; bottom: 0; right:0; width: 100%; height:100%;">
            </div>
            <div class="flat_btn" onclick="exporter()">Export to XML</div>
        </div>
    </div>
</div>
<!--End Export Modal-->


<!--Menu-->
<div class="menu">
    <div class="circle">
        <i class="icon1 fa fa-bars menu-icon"></i>
    </div>
    <div id="sub">
        <div class="circle" id="courseBtn">
            <!--            onclick='schedule.activities.add(0,2,"CPAN 204","8:55-10:40","J132","8:55 AM - 10:40 AM","Yasemin Fanaein","red");'-->
            <i class="icon1 fa fa-plus fa-lg"></i>
            <span>Add Course</span>
        </div>
        <div class="circle" id="contactBtn">
            <i class="icon1 fa fa-user fa-lg"></i>
            <span>Contact Teacher</span>
        </div>
        <div class="circle" onclick='schedule.create.newschedule()'>
            <i class="icon1 fa fa-calendar-plus-o fa-lg"></i>
            <span>New Schedule</span>
        </div>
        <div class="circle" id="exportBtn">
            <i class="icon1 fa fa-arrow-down fa-lg"></i>
            <span>Import/ Export</span>
        </div>
    </div>
</div>
<!--End Menu-->

<!--Scripts-->
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
<script src="js/exporter.js"></script>
<script src="js/index.js"></script>
<script src="js/modals.js"></script>
<script src="js/importer.js"></script>
<script>
    $(window).resize(function () {
        schedule.general.pageDimChange();
    });
</script>
<script src="js/FileSaver.js"></script>
<script type="text/javascript">
    schedule.create.newschedule();
    document.getElementsByClassName("tablinks")[0].click();
</script>
<script type="text/javascript">
    $(function () {
        var e = document.getElementById("teacherSelect");
        $('#submitButton').click(function () {
            e.preventDefault();
            $.ajax({
                url: 'includes/send_email.php',
                type: 'POST',
                data: {
                    yourName: $("#your-name").val(),
                    yourEmail: $("#email").val(),
                    yourMessage: $("#myInput").val(),
                    emailTeacher: $("#teacherSelect option:selected").val()
                },
                success: function () {
                    alert('Email Sent');
                }
            });
        });
    });
    $(function () {
      $('#myButton').click(function () {
          $.ajax({
              url: 'includes/send_email.php',
              type: 'POST',
              data: {
                  yourName: "Anon",
                  yourEmail: "Anon",
                  yourMessage: $("#myInput").val(),
                  emailTeacher: "humberschedulerapp@gmail.com"
              },
              success: function () {
                  alert('Question Submitted');
              }
          });
      });
  });
</script>
<!--End Scripts-->

</body>
</html>
