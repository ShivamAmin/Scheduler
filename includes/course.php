<?php
/**
 * Created by PhpStorm.
 * User: glave
 * Date: 2017-12-13
 * Time: 3:28 AM
 */

class Course
{

    public $scheduleNum = "scheduleNum";
    public $cRefNum;
    public $day;
    public $day2;
    public $courseDesc;
    public $courseTime;
    public $courseRoom;
    public $displayTime;
    public $courseTime2;
    public $courseRoom2;
    public $displayTime2;
    public $teachers;


    public function __construct($crefNum, $day, $courseDesc, $courseTime, $courseRoom, $displayTime, $teachers)
    {
        $this->cRefNum = $crefNum;
        $this->day = $day;
        $this->courseDesc = $courseDesc;
        $this->courseTime = $courseTime;
        $this->courseRoom = $courseRoom;
        $this->displayTime = $displayTime;
        $this->teachers = $teachers;

    }


}
