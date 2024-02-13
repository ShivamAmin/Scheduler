var schedNum = 0;
var num = 0;
var acc = document.getElementsByClassName("accordion");
var i;
var schedule = {
    initialize: function () {
        schedule.activities.set();
    },
    create: {
        newschedule: function () {

            var tab = document.getElementsByClassName("tab")[0];

            if (schedNum <= 1) {
                var tabButton = "";
                tabButton += "<button class='tablinks' onclick='openSched(event,\"sched" + schedNum + "\")'>Timetable " + (schedNum + 1) + "</button>";
                tab.innerHTML += tabButton;


                var sched = "";
                if (schedNum == 1) {
                    sched += "<div id='schedule2'>\n" +
                        " <div class='s-legend'>\n" +
                        "            <div class='s-cell s-head-info'>\n" +
                        "                <div class='s-name'>TimeTable 2</div>\n";
                } else {
                    sched += "<div id='schedule'>\n" +
                        " <div class='s-legend'>\n" +
                        "            <div class='s-cell s-head-info'>\n" +
                        "                <div class='s-name'>TimeTable 1</div>\n";
                }


                sched += "</div>\n" +
                    "            <div class='s-week-day s-cell'>\n" +
                    "                <div class='s-day'>Mon</div>\n" +
                    "            </div>\n" +
                    "            <div class='s-week-day s-cell'>\n" +
                    "                <div class='s-day'>Tue</div>\n" +
                    "            </div>\n" +
                    "            <div class='s-week-day s-cell'>\n" +
                    "                <div class='s-day'>Wed</div>\n" +
                    "            </div>\n" +
                    "            <div class='s-week-day s-cell'>\n" +
                    "                <div class='s-day'>Thu</div>\n" +
                    "            </div>\n" +
                    "            <div class='s-week-day s-cell'>\n" +
                    "                <div class='s-day'>Fri</div>\n" +
                    "            </div>\n" +
                    "        </div>\n" +
                    "        <div class='s-container s-block'>\n" +
                    "            <div class='s-head-info'>\n" +
                    "                <div class='s-head-hour'>\n" +
                    "                    <div class='s-hourly-interval'>7:00 - 8:00</div>\n" +
                    "                    <div class='s-number'>AM</div>\n" +
                    "                </div>\n" +
                    "                <div class='s-head-hour'>\n" +
                    "                    <div class='s-hourly-interval'>8:00 - 9:00</div>\n" +
                    "                    <div class='s-number'>AM</div>\n" +
                    "                </div>\n" +
                    "                <div class='s-head-hour'>\n" +
                    "                    <div class='s-hourly-interval'>9:00 - 10:00</div>\n" +
                    "                    <div class='s-number'>AM</div>\n" +
                    "                </div>\n" +
                    "                <div class='s-head-hour'>\n" +
                    "                    <div class='s-hourly-interval'>10:00 - 11:00</div>\n" +
                    "                    <div class='s-number'>AM</div>\n" +
                    "                </div>\n" +
                    "                <div class='s-head-hour'>\n" +
                    "                    <div class='s-hourly-interval'>11:00 - 12:00</div>\n" +
                    "                    <div class='s-number'>AM</div>\n" +
                    "                </div>\n" +
                    "                <div class='s-head-hour'>\n" +
                    "                    <div class='s-hourly-interval'>12:00 - 1:00</div>\n" +
                    "                    <div class='s-number'>PM</div>\n" +
                    "                </div>\n" +
                    "                <div class='s-head-hour'>\n" +
                    "                    <div class='s-hourly-interval'>1:00 - 2:00</div>\n" +
                    "                    <div class='s-number'>PM</div>\n" +
                    "                </div>\n" +
                    "                <div class='s-head-hour'>\n" +
                    "                    <div class='s-hourly-interval'>2:00 - 3:00</div>\n" +
                    "                    <div class='s-number'>PM</div>\n" +
                    "                </div>\n" +
                    "                <div class='s-head-hour'>\n" +
                    "                    <div class='s-hourly-interval'>3:00 - 4:00</div>\n" +
                    "                    <div class='s-number'>PM</div>\n" +
                    "                </div>\n" +
                    "                <div class='s-head-hour'>\n" +
                    "                    <div class='s-hourly-interval'>4:00 - 5:00</div>\n" +
                    "                    <div class='s-number'>PM</div>\n" +
                    "                </div>\n" +
                    "                <div class='s-head-hour'>\n" +
                    "                    <div class='s-hourly-interval'>5:00 - 6:00</div>\n" +
                    "                    <div class='s-number'>PM</div>\n" +
                    "                </div>\n" +
                    "                <div class='s-head-hour'>\n" +
                    "                    <div class='s-hourly-interval'>6:05 - 7:00</div>\n" +
                    "                    <div class='s-number'>PM</div>\n" +
                    "                </div>\n" +
                    "                <div class='s-head-hour'>\n" +
                    "                    <div class='s-hourly-interval'>7:05 - 8:00</div>\n" +
                    "                    <div class='s-number'>PM</div>\n" +
                    "                </div>\n" +
                    "                <div class='s-head-hour'>\n" +
                    "                    <div class='s-hourly-interval'>8:00 - 9:00</div>\n" +
                    "                    <div class='s-number'>PM</div>\n" +
                    "                </div>\n" +
                    "                <div class='s-head-hour'>\n" +
                    "                    <div class='s-hourly-interval'>9:00 - 10:00</div>\n" +
                    "                    <div class='s-number'>PM</div>\n" +
                    "                </div>\n" +
                    "            </div>\n" +
                    "            <div class='s-rows-container'>\n" +
                    "                <div class='s-activities'>\n" +
                    "                    <div class='s-act-row'></div>\n" +
                    "                    <div class='s-act-row'></div>\n" +
                    "                    <div class='s-act-row'></div>\n" +
                    "                    <div class='s-act-row'></div>\n" +
                    "                    <div class='s-act-row'></div>\n" +
                    "                </div>\n" +
                    "\n\n";


                for (var l = 0; l < 15; l++) {
                    // alert("start");
                    sched += "<div class='s-row s-hour-row'>\n";
                    for (var j = 0; j <= 4; j++) {
                        sched += "<div class='s-hour-wrapper s-cell'>\n" +
                            "                        <div class='s-half-hour'></div>\n" +
                            "                        <div class='s-half-hour'></div>\n" +
                            "                    </div>\n";
                    }
                    sched += "</div>";
                }


                sched +=
                    "\n" +
                    "            </div>\n" +
                    "        </div>\n" +
                    "    </div>";

                sched += "<div class = \"webList\" id=\"webSched" + (schedNum + 1) + "\"><h2>Timetable " + (schedNum + 1) + " Web Classes</h2></div>";


                var tabcontent = document.getElementsByClassName('centered')[0];

                var schedHolder = document.createElement("div");
                schedHolder.id = 'sched' + schedNum;
                schedHolder.classList.add('tabcontent');
                if (document.getElementsByClassName('tabcontent').length = 0) {
                    schedHolder.style.display = "block";
                } else {
                    schedHolder.style.display = "none";
                }
                schedHolder.innerHTML = sched;

                tabcontent.appendChild(schedHolder);
                schedNum++;
            }

        },
        getSchedNum: function () {
            return schedNum;
        }
    },
    //  Options
    options: {
        schedule: ['#schedule', '#schedule2'],
        lesson_time: 60, // Lesson duration in minutes
        lessons: 20, // max. number of lessons per week
        start: function () { // start at 7:00 am
            return schedule.general.toMin(7, 00)
        },
        end: function () { // end at 10:00 pm
            return schedule.general.toMin(22, 00)
        },
        h_width: $('.s-hour-row').width(), // get a width of hour div
        minToPx: function () { // divide the box width by the duration of one lesson
            return schedule.options.h_width / schedule.options.lesson_time;
        },
    },
    //  General
    general: {
        hoursRegEx: function (hours) {
            var regex = /([0-9]{1,2}).([0-9]{1,2})-([0-9]{1,2}).([0-9]{1,2})/;
            if (regex.test(hours)) {
                return true;
            } else {
                return false;
            }

        },
        toMin: function (hours, minutes, string) {
            // change time format (10:45) to minutes (645)
            if (!string) {
                return (hours * 60) + minutes;
            }

            if (string.length > 0) {
                // "7.00"
                var h = parseInt(string.split(':')[0]),
                    m = parseInt(string.split(':')[1]);

                return schedule.general.toMin(h, m);
            }
        },
        getPosition: function (start, duration, end) {
            var translateX = (start - schedule.options.start()) * schedule.options.minToPx(),
                width = duration * schedule.options.minToPx();

            return [translateX, width];
        },
        seth_width: function () {
            schedule.options.h_width = $('.s-hour-row').width();
        },
        pageDimChange: function () {
            for (var i = 0; i <= 1; i++) {
                schedule.general.seth_width();
                schedule.activities.set(i);
            }
        }
    },
    //  Activities
    activities: {
        find: function (week, hours, id) {

        },
        delete: function (schedNum, week, hours) {
            /* week: 0-4 << remove all activities from a day
               hours: "7:10-16:10" << remove all activities from a chose hours
            */
            function finalize(message) {
                if (confirm(message)) {
                    return true;
                }
            }

            if (week && !hours) {
                if (finalize("Do you want to delete all activities on the selected day?")) {
                    $('.s-activities .s-act-row:eq(' + week + ')').empty();
                }
            }

            if (!week && !hours) {
                console.log('Error. You have to add variables like a week (0-4) or hours ("9:10-10:45")!')
            }
            // if day is not defined and hours has got a correct form
            if (!week && schedule.general.hoursRegEx(hours)) {

                console.log('Week not defined and hours are defined!');

                $(schedule.options.schedule[schedNum] + ' .s-act-tab').each(function (i, v) {
                    var t = $(this), // get current tab
                        name = t.children('.s-act-name').text(), // get tab name
                        h = t.attr('data-hours').split('-'), // get tab hours
                        s = schedule.general.toMin(0, 0, h[0]), // get tab start time (min)
                        e = schedule.general.toMin(0, 0, h[1]), // get tab end time (min)
                        uh = hours.split('-'), // user chose time
                        us = schedule.general.toMin(0, 0, uh[0]), // user chose start time (min)
                        ue = schedule.general.toMin(0, 0, uh[1]); // user chose end time (min)

                    if (us <= s && ue >= e) {
                        $(this).remove();
                    }

                })

            }

            if (week && hours) {
                // if week and hours is defined
                console.log('Week is defined and hours are defined too!');

                $(schedule.options.schedule[schedNum] + ' .s-act-row:eq(' + week + ') .s-act-tab').each(function (i, v) {
                    var t = $(this), // get current tab
                        name = t.children('.s-act-name').text(), // get tab name
                        h = t.attr('data-hours').split('-'), // get tab hours
                        s = schedule.general.toMin(0, 0, h[0]), // get tab start time (min)
                        e = schedule.general.toMin(0, 0, h[1]), // get tab end time (min)
                        uh = hours.split('-'), // user chose time
                        us = schedule.general.toMin(0, 0, uh[0]), // user chose start time (min)
                        ue = schedule.general.toMin(0, 0, uh[1]); // user chose end time (min)

                    if (us <= s && ue >= e) {
                        $(this).remove();
                    }

                })


            }
        },
        //  Add
        add: function (schedNum, week, lesson, hours, classroom, times, teacher, color) {
            /* EXAMPLES -->schedNum: 0,1 (dependent on which schedule the class is going to)
             week: 0-4, lesson: "CPAN 204", hours: "9:45-12:50",
            classroom: J145, times: "9:45-12:50", teacher: "Yasemin Fanaein", color: "red" */
            if (classroom === "Web-") {
                var webClassList = document.getElementsByClassName("webList");
                var webDiv = document.createElement("div");
                var webClassInfo = teacher + " - " + lesson;
                // webDiv.innerHTML += webClassInfo;
                webDiv.classList.add('webClass');
                webDiv.classList.add('parent');
                webDiv.dataset.schednum = schedNum;
                webDiv.dataset.week = week;
                webDiv.dataset.lesson = lesson;
                webDiv.dataset.hours = hours;
                webDiv.dataset.classroom = classroom;
                webDiv.dataset.times = times;
                webDiv.dataset.teacher = teacher;
                webDiv.dataset.color = color;

                var content = document.createElement("div");
                content.innerHTML = "Delete Class";
                content.classList.add('content');

                var displayDiv = document.createElement("div");
                displayDiv.innerHTML += webClassInfo;
                displayDiv.classList.add('blur-div');

                webDiv.appendChild(content);
                webDiv.appendChild(displayDiv);

                webDiv.id = num;
                webDiv.onclick = function () {
                    deleteWebClass(this.id, webDiv.innerHTML);
                };
                webClassList[schedNum].style.display = "inline-table";
                webClassList[schedNum].appendChild(webDiv);
                num++;

            } else {
                // "<div onclick='toggleDelete(\""+lesson+"\",+schedNum+",\""+week+"\",\""+hours+"\")' class='divbutton parent s-act-tab " + color + "' data-color='" + color + "' data-hours='" + hours + "' data-day='" + week + "' data-schedNum='" + schedNum + "'>\
                var tab = "<div onclick='toggleDelete(\"" + lesson + "\"," + schedNum + ",\"" + week + "\",\"" + hours + "\")' class='divbutton parent s-act-tab " + color + "' data-color='" + color + "' data-hours='" + hours + "' data-day='" + week + "' data-schedNum='" + schedNum + "'>\
            <div class='content'>Delete Class</div><div class='blur-div'>\
            <div class='s-act-name'>" + lesson + "</div>\
            <div class='s-wrapper'>\
              <div class='s-act-teacher'>" + teacher + "</div>\
              <div class='s-act-room'>" + classroom + "</div>\
              <div class='s-act-times'>" + times + "</div>\
            </div></div>\
          </div>";
                $(schedule.options.schedule[schedNum] + ' .s-activities .s-act-row:eq(' + week + ')').append(tab);
                schedule.activities.set(schedNum);
                schedule.general.pageDimChange();
            }
        },
        set: function (schedNum) {
            $(schedule.options.schedule[schedNum] + ' .s-act-tab').each(function (i) {
                var hours = $(this).attr('data-hours').split("-"),
                    start = /* HOURS */ parseInt(hours[0].split(":")[0] * 60)
                        + /* MINUTES */ parseInt(hours[0].split(":")[1]),
                    end = /* HOURS */ parseInt(hours[1].split(":")[0] * 60)
                        + /* MINUTES */ parseInt(hours[1].split(":")[1]),
                    duration = end - start,
                    translateX = schedule.general.getPosition(start, duration, end)[0],
                    width = schedule.general.getPosition(start, duration, end)[1];
                $(this)
                    .attr({"data-start": start, "data-end": end})
                    .css({"transform": "translateX(" + translateX + "px)", "width": width + "px"});
            });
            // schedule.general.pageDimChange();
        }
    }

};

function toggleDelete(cRefNum, schedNum, week, times) {
    schedule.activities.delete(schedNum, week, times);
    var elements = document.getElementsByClassName('s-act-name');
    for (var i = 0; i < elements.length; i++) {
        if (elements[i].innerHTML.indexOf(cRefNum) !== -1) {
            elements[i].click();
        }
    }
}


function deleteWebClass(classID, className) {
    var elements = document.getElementsByClassName('webClass');
    for (var i = 0; i < elements.length; i++) {
        if (elements[i].innerHTML.indexOf(className) !== -1) {
            if (elements[i].id === classID) {
                elements[i].remove();
            }
        }
    }
}

function openSched(evt, schedName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(schedName).style.display = "block";
    evt.currentTarget.className += " active";
}

function updateTable() {
    var input, filter, table, tr, td, i, button;
    button = document.getElementById("myButton");
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");
    hidden = 0;
    button.style.display = "none";

    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByClassName("accordion")[0];
        if (td) {
            if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
            if (input.value.toUpperCase() == "") {
                tr[i].style.display = "none";
            }
        }
        if (tr[i].style.display == "none") {
            hidden++;
        }
    }
    if (tr.length - 1 == hidden && input.value.toUpperCase() != "") {
        button.style.display = "";
    } else {
        button.style.display = "none";
    }
}

for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function () {
        this.classList.toggle("active-acc");
        var panel = this.nextElementSibling;
        if (panel.style.maxHeight) {
            panel.style.maxHeight = null;
        } else {
            panel.style.maxHeight = panel.scrollHeight + "px";
        }
    });
}
document.getElementById("myButton").style.display = "none";
schedule.initialize();
