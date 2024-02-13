//Opening and Closing the Modal

// Get the modal
var coursem = document.getElementById('courseModal');
var contactm = document.getElementById('contactModal');
var exportm = document.getElementById('exportModal');

// Get the button that opens the modal
var coursebtn = document.getElementById('courseBtn');
var contactbtn = document.getElementById('contactBtn');
var exportbtn = document.getElementById('exportBtn');

// Get the <span> element that closes the modal
var courseclose = document.getElementsByClassName("close")[0];
var contactclose = document.getElementsByClassName("close")[1];
var exportclose = document.getElementsByClassName("close")[2];

//Add Course Modal
coursebtn.onclick = function () {
    coursem.style.display = "block";
    if (schedule.create.getSchedNum() >= 2) {
        document.getElementById('schedSelect').innerHTML = '<p>Select a Timetable to add this course to</p><select name="scheduleNum" onchange="" class="minimal" onclick="return false;" id="schedSelection" >' +
            '<option name="schedule1" value="0">Timetable 1</option> ' +
            '<option name="schedule2" value="1">Timetable 2</option> ' +
            '</select>';
    }
};

//Contact Modal
contactbtn.onclick = function () {
    contactm.style.display = "block";
    var tSelect = document.getElementById("teacherSelect");
    var teacherList = document.getElementsByClassName('s-act-teacher');
    var courseList = document.getElementsByClassName('s-act-name');
    tSelect.innerHTML = "";
    for (var i = 0; i < teacherList.length; i++) {
        var option = document.createElement("option");
        option.text = teacherList[i].innerHTML + " - " + courseList[i].innerHTML;
        tSelect.add(option);

    }

    var webTeacher = document.getElementsByClassName("webClass");

    for (var j = 0; j < webTeacher.length; j++) {
        var option = document.createElement("option");
        option.text = webTeacher[i].getElementsByClassName("blur-div")[0].innerHTML;
        tSelect.add(option);
    }

    var optionValues = [];
    $('#teacherSelect option').each(function () {
        if ($.inArray(this.value, optionValues) > -1) {
            $(this).remove()
        } else {
            optionValues.push(this.value);
        }
    });
};

//Export Modal
exportbtn.onclick = function () {
    exportm.style.display = "block";
};


// When the user clicks on <span> , close the modal
courseclose.onclick = function () {
    coursem.style.display = "none";
};
contactclose.onclick = function () {
    contactm.style.display = "none";
};
exportclose.onclick = function () {
    exportm.style.display = "none";
};

// When the user clicks anywhere outside of the modal, close it
window.onclick = function (event) {
    if (event.target == coursem) {
        coursem.style.display = "none";
    }
    if (event.target == exportm) {
        exportm.style.display = "none";
    }
    if (event.target == contactm) {
        contactm.style.display = "none";
    }


};


//Contact Form JS

function resizeInput() {
    $(this).attr('size', $(this).val().length);
}

$('input[type="text"], input[type="email"]')
    .keyup(resizeInput)
    .each(resizeInput);


console.clear();
(function () {

    var textareas = document.querySelectorAll('.expanding'),

        resize = function (t) {
            t.style.height = 'auto';
            t.style.overflow = 'hidden';
            t.style.height = (t.scrollHeight + t.offset) + 'px';
            t.style.overflow = '';
        },

        attachResize = function (t) {
            if (t) {
                console.log('t.className', t.className);
                t.offset = !window.opera ? (t.offsetHeight - t.clientHeight) : (t.offsetHeight + parseInt(window.getComputedStyle(t, null).getPropertyValue('border-top-width')));

                resize(t);

                if (t.addEventListener) {
                    t.addEventListener('input', function () {
                        resize(t);
                    });
                    t.addEventListener('mouseup', function () {
                        resize(t);
                    });
                }

                t['attachEvent'] && t.attachEvent('onkeyup', function () {
                    resize(t);
                });
            }
        };


    if (!document.querySelectorAll) {

        function getElementsByClass(searchClass, node, tag) {
            var classElements = [];
            node = node || document;
            tag = tag || '*';
            var els = node.getElementsByTagName(tag);
            var elsLen = els.length;
            var pattern = new RegExp("(^|\\s)" + searchClass + "(\\s|$)");
            for (i = 0, j = 0; i < elsLen; i++) {
                if (pattern.test(els[i].className)) {
                    classElements[j] = els[i];
                    j++;
                }
            }
            return classElements;
        }

        textareas = getElementsByClass('expanding');
    }

    for (var i = 0; i < textareas.length; i++) {
        attachResize(textareas[i]);
    }

})();


function addCourse() {
    var eID = document.getElementById('courseSelect');
    var courseVal = eID.options[eID.selectedIndex].value;
    var timeTable = 0;
    if (schedule.create.getSchedNum() >= 2) {
        var tID = document.getElementById('schedSelection');
        timeTable = tID.options[tID.selectedIndex].value;

    } else {
        timeTable = 0;
    }

    var courseSelect = courseVal.replace(/%scheduleNum%/g, timeTable);
    // alert(courseSelect);
    if (!eval(courseSelect)) {
        alert("Course was successfully added!");
    }

}





